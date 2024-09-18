<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Base;
use App\Models\Bin;
use App\Settings\GeneralSettings;
use App\Settings\Tools\PasteAndShareTextSettings;
use App\Settings\ToolSlugSettings;
use Illuminate\Support\Facades\DB;

class PasteAndShareTextController extends Base{

    public function index($tool, $settings, $related){

        $error = false;
        $created = false;

        if(request()->input('submit')){
            $fields = request()->validate([
                'text_content' => 'required|min:1'
            ]);

            if($fields['text_content']) {
                $bin = new Bin();

                $bin->content = htmlentities($fields['text_content']);

                $bin->save();

                $bin->slug = md5(time() . $bin->id . rand(0, 999));

                $bin->save();

                $created = $bin;
            }
            if(request()->input('text_content')){
                $decoded_printable = quoted_printable_decode(request()->input('decodeQuote'));
            }
            else{
                $error = true;
            }
        }


        return view('modules.tools.paste-and-share-text.view', [
            'title'         => $settings->title,
            'description'   => $settings->metaDescription,
            'keywords'      => $settings->metaKeywords,
            'summary'       => $settings->summary,

            'tool'    => $tool,
            'toolSettings' => $settings,
            'toolSlugs'    => app(ToolSlugSettings::class),
            'related' => $related,

            'created' => $created,
            'error' => $error
        ]);
    }

    public function view($bin, PasteAndShareTextSettings $settings) {
        $bin = Bin::where('slug', trim(strtolower($bin)))->first();

        if($bin) {
            return view('modules.tools.paste-and-share-text.view-bin', [
                'title'         => $settings->title,
                'description'   => $settings->metaDescription,
                'keywords'      => $settings->metaKeywords,
                'summary'       => $settings->summary,

                'bin' => $bin
            ]);
        }

        return abort(404);
    }
}
