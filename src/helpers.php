<?php
if (!function_exists('_fixDirSeparator')) {

    function _fixDirSeparator($path) {
        return str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
    }

}
if (!function_exists('AssetsAdmin')) {

    function AssetsAdmin($path, $type = 'css') {
        return ($type == 'css') ? '<link href="' . url('assets/admin/assets/css/' . $path) . '" rel="stylesheet" type="text/css">' : '<script type="text/javascript" src="' . url('assets/admin/assets/js/' . $path) . '"></script>';
    }

}

if (!function_exists('AssetsMain')) {

    function AssetsMain($path, $type = 'css') {
        return ($type == 'css') ? '<link href="' . url('assets/front/css/' . $path) . '" rel="stylesheet" type="text/css">' : '<script type="text/javascript" src="' . url('assets/front/js/' . $path) . '"></script>';
    }

}

if (!function_exists('MsgError')) {

    function MsgError($key, $message) {
        return [
            'key' => $key,
            'value' => __($message),
        ];
    }

}

if (!function_exists('DashBoardReportsType')) {

    function DashBoardReportsType($val = null) {
        $data = [
            1 => 'counter',
            2 => 'chart',
        ];
        if ($val == null) {
            return $data;
        }
        return $data[$val];
    }

}
if (!function_exists('DashBoardReports')) {

    function DashBoardReports() {
        $dashboardMenus = '';

        $glob = glob(__DIR__ . '/**/Resources/Reports/*.php');
        $f = collect($glob)->groupBy(
                function ($el) {
            return pathinfo($el)['filename'];
        }
        );
        $f->transform(
                function ($item) {
            $data = [];
            foreach ($item as $value) {
                $data[] = include $value;
            }
            return collect(array_filter($data));
        }
        );
        foreach (DashBoardReportsType() as $value) {
            $data[$value] = [];
        }
        if(!is_null($f->get('report'))) {
            foreach ($f->get('report') as $val) {
                if (is_array($val['type'])) {
                    foreach (DashBoardReportsType() as $value) {
                        $data[$value][] = $val;
                    }
                } else {
                    if (array_key_exists($val['type'], $data)) {
                        $data[$val['type']][] = $val;
                    }
                }
            }
        }
        return $data;
    }

}

if (!function_exists('AdminMenu')) {

    function AdminMenu() {
        $dashboardMenus = '';

        $glob = glob(app_path('/Components') . '/**/Resources/menu/*.php');
        $f = collect($glob)->groupBy(
                function ($el) {
            return pathinfo($el)['filename'];
        }
        );
        $f->transform(
                function ($item) {
            $data = [];
            foreach ($item as $value) {
                $data[] = include $value;
            }
            return collect(array_filter($data));
        }
        );
        foreach ($f->get('menu') as $main_item) {
            $icon = isset($main_item['icon']) ? $main_item['icon'] : '';
            $title = isset($main_item['title']) ? __($main_item['title']) : '';
            $hasItems = isset($main_item['items']) && !empty($main_item['items']);
            $url = isset($main_item['url']) ?  route('dashboard.' . $main_item['url']) : '#';
            $c = '';
            if ($hasItems) {
                $c = 'has-ul';
            }
            if ($hasItems) {
                $dashboardMenus .= '<li><a href="#" class="legitRipple ' . $c . '"><i class="' . $icon . '"></i> <span>' . __($title) . '</span></a>';
                $dashboardMenus .= AdminMenuTree($main_item['items']);
            } else {
                $dashboardMenus .= '<li><a href="' . $url. '" class="legitRipple ' . $c . '"><i class="' . $icon . '"></i> <span>' . __($title) . '</span></a>';
            }
            $dashboardMenus .= '</li>';
        }
        return $dashboardMenus;
    }

}

if (!function_exists('AdminMenuTree')) {

    function AdminMenuTree($array, $hasul = '') {
        $menu = '<ul class="' . $hasul . '">';
        foreach ($array as $val) {
            $url = route('dashboard.' . $val['url']);
            if (array_key_exists('items', $val)) {
                $menu .= '<li><a href="' . $url . '" class="has-ul legitRipple">' . __($val['title']) . '</a>';
                $menu .= AdminMenuTree($val['items'], 'hidden-ul');
                $menu .= '</li>';
            } else {
                $menu .= '<li><a href="' . $url . '" class="legitRipple">' . __($val['title']) . '</a></li>';
            }
        }
        $menu .= '</ul>';
        return $menu;
    }

}

if (!function_exists('delete_list_from_table')) {

    function delete_list_from_table($route, $id) {
        echo '<form action="' . route($route, $id) . '" method="post">
        <input name="_method" type="hidden" value="delete">
        <input type="hidden" name="_token" id="csrf-token" value="' . Session::token() . '" />
        <button type="submit" class="btn btn-danger delete-record" data-toggle="tooltip" title="'.__('delete').'"><i class="icon-trash"></i></button>
        </form>';
    }

}


if (!function_exists('localization_form_tabs')) {

    function localization_form_tabs() {
        $i = 0;
        ?>
        <ul class="nav nav-tabs nav-tabs-bottom">
            <?php foreach (config('laravellocalization.supportedLocales') as $key => $item): ?>
                <li class = "<?php echo ($i++ == 0) ? 'active' : '' ?>">
                    <a href = "#bottom-tab<?php echo $item['regional'] ?>" data-toggle = "tab"><?php echo $item['native'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
    }

}

if (!function_exists('from_submit')) {

    function from_submit($title = 'Save') {
        ?>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">
                <?php echo __($title) ?>
                <i class="icon-arrow-left13 position-right"></i>
            </button>
        </div>
        <?php
    }

}

if (!function_exists('from_input')) {

    function from_input($name, $label, $type = 'text', $value = '', $lang = null, $autocomplete = null) {
        if ($lang) {
            $name = $lang . '[' . $name . ']';
        }
        if ($autocomplete) {
            $autocomplete = "autocomplete='$autocomplete'";
        } else {
            $autocomplete = '';
        }
        $label = __($label);
        return view('inputs.input' , get_defined_vars());
    }

}

if (!function_exists('from_input_textarea')) {

    function from_input_textarea($name, $label, $value = '', $lang = '') {
        if ($lang) {
            $name = $lang . '[' . $name . ']';
        }
        echo '<div class="form-group">
        <label class="control-label col-lg-2">' . __($label) . '</label>
        <div class="col-md-10">
                <textarea class="form-control" name="' . $name . '" />' . $value . '</textarea>
        </div>
    </div>';
    }

}

if (!function_exists('from_image')) {

    function from_image($name, $value = '', $label,$multiple = false) {
        $multiple = ($multiple) ? 'multiple' : '';
        $name = ($multiple) ? $name . '[]' : $name;
        $value = ($value == '') ? '' : url($value);
        $input = '<div class="form-group form-group-material">';
        $input .= '<label class="col-lg-2">' . __($label) . '</label>';
        if ($value != '') {
            $input .= '<img src="' . $value . '" style=" width: 50px; height: 50px;margin-bottom: 10px;"/>';
        }
        $input .= '<input type="file" name="' . $name . '" class="file-styled" ' . $multiple . '>';
        $input .= '</div>';
        return $input;
    }

}

if (!function_exists('BaseImage')) {

    function BaseImage($img) {
        $img = str_replace(['data:image/png;base64,', 'data:image/jpeg;base64,', 'data:image/jpg;base64,'], '', $img);
        $data = base64_decode($img);
        return $data;
    }

}


if (!function_exists('file_upload')) {

    function file_upload($file, $path = '', $wh = [], $base64 = false, $watermark = false) {
        $destinationPath = ($path == '') ? "uploads" : "uploads/" . $path;
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        if ($base64 == true) {
            $file = Image::make(BaseImage($file));
            $input = md5(time() . rand(10000, 99999)) . '.jpg';
        } else {
            $input = md5(time() . rand(10000, 99999)) . '.' . $file->getClientOriginalExtension();
            $file = Image::make($file->getRealPath());
        }


        if (!empty($wh)) {
            $file->resize($wh['w'], $wh['h']);
        }
        if ($watermark == true) {
            $file->insert('/test.png');
        }
        $file->save($destinationPath . '/' . $input);
        return $destinationPath . '/' . $input;
    }

}


if (!function_exists('from_input_select')) {

    function from_input_select($array, $name, $lable, $select = 0) {
        $input = '<div class="col-md-12">';
        $input .= '<span>' . __($lable) . '</span>';
        $input .= '<select data-placeholder="' . __($lable) . '" class="select-size-lg" name="' . $name . '">';
        $input .= '<option value="">' . __("All $lable") . '</option>';
        foreach ($array as $value) {
            $selected = ($value->id == $select) ? 'selected' : '';
            $input .= "<option value='$value->id' $selected>$value->name</option>";
        }
        $input .= '</select>';
        $input .= ' </div>';
        return $input;
    }

}



if (!function_exists('WebSettingGet')) {

    function WebSettingGet($var, $default = null) {
        static $dbdata = null;
        if ($dbdata == null) {
            $dbdata = \App\Components\Option\Model\Option::all()->toArray();
        }
        $data = array_column($dbdata, 'value', 'key');
        return isset($data[$var]) ? $data[$var] : $default;
    }

}



if (!function_exists('WebSettingInput')) {

    function WebSettingInput($key, $value, $type = 'text') {
        if ($type != 'image') {
            return from_input($key, $value, $type, WebSettingGet($key));
        } else {
            return from_image($key, WebSettingGet($key),$key);
        }
    }

}

if (!function_exists('GetPlaceInformation')) {

    function GetPlaceInformation($lat, $lng, $info = 'place_id') {
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lng&sensor=true&key=AIzaSyDJl_wkkIlZvHFV2K9X8G6hYVaD6L_ndso";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response);
        if ($response_a->status == 'OK') {
            if ($info == 'place_id') {
                $data = $response_a->results[2]->place_id;
            } else {
                $data = $response_a->results[2]->address_components[0]->long_name;
            }
            return $data;
        } else {
            return 100;
        }
    }

}

if (!function_exists('vue_srcs')) {

    function vue_srcs() {
        echo <<<HTML
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.11/lodash.min.js"></script>
HTML;
    }

}

if (!function_exists('gen_temp_email')) {

    function gen_temp_email($mobile) {
        return $mobile . '-afnan@afnan.com';
    }

}
if (!function_exists('sanitize_mobile')) {

    function sanitize_mobile($number) {
        $number = preg_replace('/\s+/', '', $number);
        $number = '966' . substr((string) $number, -9);
        return $number;
    }

}

if (!function_exists('cart_get_product')) {

    function cart_get_product($id) {
        return Cart::get($id);
    }

}

if (!function_exists('cart_get_product_qty')) {

    function cart_get_product_qty($id) {
        $product = cart_get_product($id);
        return $product ? $product->quantity : 0;
    }

}

if (!function_exists('cart_get_total')) {

    function cart_get_total() {
        return Cart::getTotal();
    }

    if (!function_exists('cart_get_payment_total')) {

        function cart_get_payment_total() {
            return str_replace([',', '.'], '', (string) cart_get_total());
        }

    }
}

if (!function_exists('blade_request_message')) {

    function blade_request_message($message = '', $type = 'error') {
        return [
            'text' => $message,
            'icon' => WebSettingGet("{$type}_icon", defult_color($type)['icon']),
            'color' => WebSettingGet("{$type}_color", defult_color($type)['color']),
            'text_color' => WebSettingGet("{$type}_text_color", defult_color($type)['text_color']),
        ];
    }

}

if (!function_exists('defult_color')) {

    function defult_color($type = 'error') {
        $defult = [
            'error' => [
                'icon' => 'fas fa-info-circle',
                'color' => '#ff4141',
                'text_color' => '#ffffff',
            ],
            'info' => [
                'icon' => 'fas fa-question-circle',
                'color' => '#e6f6fb',
                'text_color' => '#000000',
            ],
            'success' => [
                'icon' => 'fas fa-check-circle',
                'color' => '#76b042',
                'text_color' => '#ffffff',
            ],
        ];
        return $defult[$type];
    }

}


if (!function_exists('MsgError')) {

    function MsgError($key, $message) {
        return [
            [
                'key' => $key,
                'value' => __($message),
            ]
        ];
    }

}