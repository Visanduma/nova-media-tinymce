<?php

namespace Visanduma\NovaImageTinymce;


use Laravel\Nova\Fields\Expandable;
use Laravel\Nova\Fields\Field;

class NovaImageTinymceEditor extends Field
{
    use Expandable;

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-image-tinymce-editor';

    public function __construct(string $name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute);
        $this->resolveCallback = $resolveCallback;

        $this->withMeta([
            'options' => config('nova-image-tinymce.options', []),
            'imageGalary' => false,
            'upload' => true
        ]);
    }

    public function options($options)
    {
        $inlineOptions = $this->meta['options'] ?? [];

        return $this->withMeta([
            'options' => array_merge($inlineOptions, $options),
        ]);
    }

    /**
     * Set the field id html attribute.
     *
     * @param mixed $id
     *
     * @return $this
     */
    public function id($id)
    {
        $this->withMeta([
            'id' => $id,
        ]);

        return $this;
    }

    /**
     * Set the field name.
     *
     * @param mixed $name
     *
     * @return $this
     */
    public function name($name)
    {
        $this->withMeta([
            'name' => $name,
        ]);

        return $this;
    }

    /**
     * Set the field placeholder.
     *
     * @param mixed $name
     * @param mixed $placeholder
     *
     * @return $this
     */
    public function placeholder($placeholder)
    {
        $this->withMeta([
            'placeholder' => $placeholder,
        ]);

        return $this;
    }

    public function useImageGallary()
    {
        $this->withMeta([
            'imageGallary' => true,
        ]);

        return $this;
    }

    public function withoutImageUpload()
    {
        $this->withMeta([
            'upload' => false
        ]);

        return $this;
    }

    /**
     * Prepare the element for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [
            'shouldShow' => $this->shouldBeExpanded(),
        ]);
    }
}
