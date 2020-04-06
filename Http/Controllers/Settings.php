<?php

namespace Modules\Plaka\Http\Controllers;

use App\Abstracts\Http\Controller;
use Artisan;
use Illuminate\Http\Response;
use Modules\Plaka\Http\Requests\Setting as Request;
use Modules\Plaka\Http\Requests\SettingGet as GRequest;
use Modules\Plaka\Http\Requests\SettingDelete as DRequest;

class Settings extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit()
    {
        $methods = json_decode(setting('plaka.methods'));

        return view('plaka::edit', compact('methods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function update(Request $request)
    {
        $methods = json_decode(setting('plaka.methods'), true);

        if (!empty($request->get('update_code', null))) {
            foreach ($methods as $key => $method) {
                if ($method['code'] != $request->get('update_code')) {
                    continue;
                }

                $method = explode('.', $request->get('update_code'));

                $methods[$key] = [
                    'code' => 'plaka.' . $request->get('code') . '.' . $method[2],
                    'name' => $request->get('name'),
                    'customer' => $request->get('customer'),
                    'order' => $request->get('order'),
                    'description' => $request->get('description'),
                ];
            }

            $message = trans('messages.success.updated', ['type' => $request['name']]);
        } else {
            $methods[] = [
                'code' => 'plaka.' . $request->get('code') . '.' . (count($methods) + 1),
                'name' => $request->get('name'),
                'customer' => $request->get('customer'),
                'order' => $request->get('order'),
                'description' => $request->get('description'),
            ];

            $message = trans('messages.success.added', ['type' => $request->get('name')]);
        }

        setting()->set('plaka.methods', json_encode($methods));

        setting()->save();

        Artisan::call('cache:clear');

        $response = [
            'status' => null,
            'success' => true,
            'error' => false,
            'message' => $message,
            'data' => null,
            'redirect' => route('plaka.settings.edit'),
        ];

        flash($message)->success();

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  GRequest  $request
     *
     * @return Response
     */
    public function get(GRequest $request)
    {
        $data = [];

        $code = $request->get('code');

        $methods = json_decode(setting('plaka.methods'), true);

        foreach ($methods as $key => $method) {
            if ($method['code'] != $code) {
                continue;
            }

            $method['title'] = trans('plaka::plaka.edit', ['method' => $method['name']]);
            $method['update_code'] = $code;

            $code = explode('.', $method['code']);

            $method['code'] = $code[1];

            $data = $method;

            break;
        }

        return response()->json([
            'errors' => false,
            'success' => true,
            'data'    => $data,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DRequest  $request
     *
     * @return Response
     */
    public function destroy(DRequest $request)
    {
        $code = $request->get('code');

        $methods = json_decode(setting('plaka.methods'), true);

        $remove = false;

        foreach ($methods as $key => $method) {
            if ($method['code'] != $code) {
                continue;
            }

            $remove = $methods[$key];
            unset($methods[$key]);
        }

        // Set Api Token
        setting()->set('plaka.methods', json_encode($methods));

        setting()->save();

        Artisan::call('cache:clear');

        $message = trans('messages.success.deleted', ['type' => $remove['name']]);

        // because it show nofitication.
        //flash($message)->success();

        return response()->json([
            'errors' => false,
            'success' => true,
            'message' => $message,
            'redirect' => route('plaka.settings.edit'),
        ]);
    }
}
