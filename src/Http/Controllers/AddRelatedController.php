<?php declare(strict_types=1);

namespace KiryaDev\Admin\Http\Controllers;

use KiryaDev\Admin\Fields\MorphTo;
use KiryaDev\Admin\Http\Requests\AddRelatedResourceRequest;

class AddRelatedController
{
    use Traits\HandlesForm;

    public function handle(AddRelatedResourceRequest $request)
    {
        $resource = $request->resource();

        $object = $resource->newModel();

        // fixme  right use HasMany.. then when saving call $hasManyField->save($object)
        $field = $request->resolveRelatedField();
        $field->disable();

        if ($field instanceof MorphTo) {
            $field->fill($object, [$request->resource => $request->id]);
        } else {
            $field->fill($object, $request->id);
        }

        return $this->doHandle(
            $request,
            $resource,
            $object
        );
    }
}
