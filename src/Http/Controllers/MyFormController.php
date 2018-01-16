<?php

namespace BtyBugHook\Membership\Http\Controllers;

use App\Http\Controllers\Controller;
use Btybug\Console\Models\FormFields;
use Btybug\Console\Models\Forms;
use Btybug\Console\Repository\FieldsRepository;
use Btybug\Console\Repository\FormsRepository;
use Btybug\Console\Services\FormService;
use BtyBugHook\Blog\Services\ReplaceAtor;
use Illuminate\Http\Request;

class MyFormController extends Controller
{
    public function getMyFormsEdit (
        $id,
        FormsRepository $formsRepository,
        FieldsRepository $fieldsRepository,
        FormService $formService
    )
    {
        $form = $formsRepository->findOneByMultiple(['id' => $id,'created_by' => 'plugin']);
        if( ! $form) abort(404,"Form not found");

        $fields = $fieldsRepository->getBy('table_name','posts');
        $existingFields = (count($form->form_fields)) ? $form->form_fields()->pluck('field_slug','field_slug')->toArray() : [];

        return view('mbshp::cars.forms.edit',compact('form','fields','existingFields'));
    }

    public function postRenderField(
        Request $request,
        FieldsRepository $fieldsRepository
    )
    {
        $field = $fieldsRepository->findByTableAndCol($request->table, $request->field);

        if ($field && view()->exists("mbshp::cars._partials.custom_fields." . $field->type)) {
            $html = \view("mbshp::cars._partials.custom_fields." . $field->type)->with('field', $field->toArray())->render();
            return ['error' => false, 'html' => $html];
        }
        return ['error' => true];
    }

    public function postSaverForm(
        Request $request,
        FieldsRepository $fieldsRepository,
        FormService $formService
    )
    {
        $data = $request->except('_token');
        $id = $data['id'];
        $fields = $data['fields_json'];
        $html = "{{--Form $id --}}\r\n" . \File::get(plugins_path('vendor/btybug.hook/blog/src/views/_partials/custom_fields/fheader.blade.php')) . "\r\n";
        foreach ($fields as $field) {
            $field = $fieldsRepository->findByTableAndCol('posts', $field);
            $path = plugins_path('vendor/btybug.hook/blog/src/views/_partials/custom_fields/' . $field->type . '.blade.php');
            if (\File::exists($path)) {
                $blade = \File::get($path) . "\r\n";
                $html .= ReplaceAtor::replace($blade, $field);
            }
        }
        $html .= \File::get(plugins_path('vendor/btybug.hook/blog/src/views/_partials/custom_fields/ffooter.blade.php')) . "\r\n";
        $data['fields_html'] = $html;
        $data['fields_json'] = array_keys($fields);

        $formService->createOrUpdate($data);

        return ['error' => false];
    }
}