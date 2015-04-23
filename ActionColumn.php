<?php

namespace flyiing\grid;

use Yii;
use yii\bootstrap\Button;
use yii\helpers\ArrayHelper;
use flyiing\uni\Icon;

class ActionColumn extends \yii\grid\ActionColumn {

    public $template = '<div class="btn-group btn-group-sm action-column" role="group">{view} {update}</div> {delete}';

    public static function renderDefaultButton($title, $url, $model, $key, $options = [])
    {
        $options = ArrayHelper::merge([
            'href' => $url,
            'class' => 'btn btn-default',
            'data-pjax' => 0,
        ], $options);
        return Button::widget([
            'tagName' => 'a',
            'encodeLabel' => false,
            'label' => $title,
            'options' => $options,
        ]);
    }

    protected function initDefaultButtons()
    {
        if (!isset($this->buttons['view'])) {
            $this->buttons['view'] = function($url, $model, $key) {
                return static::renderDefaultButton(Icon::show('eye-open') . Yii::t('yii', 'View'), $url, $model, $key, [
                    'class' => 'btn btn-default',
                ]);
            };
        }
        if (!isset($this->buttons['update'])) {
            $this->buttons['update'] = function($url, $model, $key) {
                return static::renderDefaultButton(Icon::show('edit') . Yii::t('yii', 'Update'), $url, $model, $key, [
                    'class' => 'btn btn-primary',
                ]);
            };
        }
        if (!isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function($url, $model, $key) {
                return static::renderDefaultButton(Icon::show('trash') . Yii::t('yii', 'Delete'), $url, $model, $key, [
                    'class' => 'btn btn-xs btn-danger',
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'data-method' => 'post',
                ]);
            };
        }
    }

}