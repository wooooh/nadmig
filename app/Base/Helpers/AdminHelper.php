<?php

if (!function_exists('get_ops')) {
    /**
     * Returns resource operations for the datatables or nested sets
     *
     * @param $resource
     * @param $id
     * @param $class
     * @return string
     */
    function get_ops($resource, $id, $class = "btn", $options, $show_path = null)
    {
        if ($class=="btn") {
            $show_class = "btn btn-xs bg-navy";
            $edit_class = "btn btn-xs bg-olive";
            $delete_class = "btn btn-xs btn-danger destroy";
        } else {
            $show_class = "inline-show";
            $edit_class = "inline-edit";
            $delete_class = "inline-delete";
        }
        if(!$show_path){
            $show_path = route('dashboard.'.$resource.'.show', ['id' => $id]);
        }
        $edit_path = route('dashboard.'.$resource.'.edit', ['id' => $id]);
        $delete_path = route('dashboard.'.$resource.'.destroy', ['id' => $id]);
        $ops  = '<ul class="list-inline no-margin-bottom">';
        if (in_array("show", $options)) {
            $ops .=  '<li>';
            $ops .=  '<a class="'.$show_class.'" href="'.$show_path.'">
                      <i class="fa fa-eye"></i>
                      '.trans('dashboard.ops.show').'</a>';
            $ops .=  '</li>';
        }
        if (in_array("edit", $options)) {
            $ops .=  '<li>';
            $ops .=  '<a class="'.$edit_class.'" href="'.$edit_path.'">
                     <i class="fa fa-pencil-square-o"></i>
                      '.trans('dashboard.ops.edit').'</a>';
            $ops .=  '</li>';
        }
        if (in_array("delete", $options)) {
            $ops .=  '<li>';
            $ops .= Form::open(['method' => 'DELETE', 'url' => $delete_path]);
            $ops .= Form::submit('&#xf1f8; ' .trans('dashboard.ops.delete'), [
                    'onclick' => "return confirm('".trans('dashboard.ops.confirmation')."');",
                    'class' => $delete_class
                ]);
            $ops .= Form::close();
            $ops .=  '</li>';
        }
        $ops .=  '</ul>';
        return $ops;
    }
}


if (!function_exists('breadcrumbs')) {
    /**
     * Return breadcrumbs for each resource methods
     *
     * @return string
     */
    function breadcrumbs()
    {
        $route = Route::currentRouteName();

        // get after last dot
        $index = substr($route, 0, strrpos($route, '.') + 1) . 'index';
        $breadcrumbs  = '<ol class="breadcrumb">';
        $breadcrumbs .= '<li><a href="'.route('dashboard.root').'">
                        <i class="fa fa-dashboard"></i>
                        '.trans('dashboard.menu.dashboard').'</a></li>';
        // if not admin root
        if (strpos($route, 'root')  === false) {
            $parent_text   = strpos($route, 'index')  !== false ? trans( isModule().$route) : trans( isModule().$index);
            $breadcrumbs  .= strpos($route, 'index')  !== false ? '<li class="active">' : '<li>';
            $breadcrumbs  .= strpos($route, 'index')  !== false ? $parent_text :
                '<a href="'.route($index).'">'.$parent_text.'</a>';
            $breadcrumbs  .= '</li>';
            if (strpos($route, 'index')  === false) {
                $breadcrumbs  .= '<li class="active">'.trans( isModule().$route).'</li>';
            }
        }
        $breadcrumbs .= '</ol>';
        return $breadcrumbs;
    }
}

if (!function_exists('header_title')) {
    /**
     * Return the header title for each page
     *
     * @return string
     */
    function header_title()
    {
        $route = Route::currentRouteName();

        $title = '<h1>';

        $title .= trans(isModule().Route::getCurrentRoute()->getName());
        if (strpos($route, 'index') !== false) {
            $new = substr($route, 0, strrpos($route, '.') + 1) . 'create';

            if (Route::has($new)) {
                $title .= '<small>';
                $title .= '<a href="'.route($new).'" title="'.trans(isModule().$new).'">';
                $title .= '<i class="fa fa-plus"></i>';
                $title .= '</a>';
                $title .= '</small>';
            }
        }
        $title .= '</h1>';
        return $title;
    }
}

if (!function_exists('rename_file')) {
    /**
     * Rename the filename, convert string to url friendly form and attach random string
     *
     * @param $filename
     * @param $mime
     * @return string
     */
    function rename_file($filename, $mime)
    {
        // remove extension first
        $filename = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
        $filename = str_slug($filename, "-");
        $filename = '/' . $filename . '_' . str_random(32) .  '.' . $mime;
        return $filename;
    }
}

if (!function_exists('renderNode')) {
    /**
     * Render nodes for nested sets
     *
     * @param $node
     * @param $resource
     * @return string
     */
    function renderNode($node, $resource)
    {
        $id = 'data-id="' . $node->id .'"';
        $list = 'class="dd-list"';
        $class = 'class="dd-item"';
        $handle = 'class="dd-handle"';
        $title  = '<span class="ol-buttons"> ' . get_ops($resource, $node->id, "btn", ["show", "edit", "delete"]) . '</span>';
        $title  .= '<div '.$handle.'>' . $node->title . '</div>';
        if ($node->isLeaf()) {
            return '<li '.$class.' '.$id.'>' . $title . '</li>';
        } else {
            $html = '<li '.$class.' '.$id.'>' . $title;
            $html .= '<ol '.$list.'>';
            foreach ($node->children as $child) {
                $html .= renderNode($child, $resource);
            }
            $html .= '</ol>';
            $html .= '</li>';
        }
        return $html;
    }
}

if (!function_exists('renderNodeMenu')) {
    /**
     * Render nodes for nested sets
     *
     * @param $node
     * @param $resource
     * @return string
     */
    function renderNodeMenu($node, $resource)
    {
        $id = 'data-id=menu-"' . $node->id .'"';
        $list = 'class="dd-list"';
        $class = 'class="dd-item"';
        $handle = 'class="dd-handle"';
        $title  = '<div '.$handle.'>' . $node->title . '</div>';
        if ($node->isLeaf()) {
            return '<li '.$class.' '.$id.'>' . $title . '</li>';
        } else {
            $html = '<li '.$class.' '.$id.'>' . $title;
            $html .= '<ol '.$list.'>';
            foreach ($node->children as $child) {
                $html .= renderNode($child, $resource);
            }
            $html .= '</ol>';
            $html .= '</li>';
        }
        return $title;
    }
}

if (!function_exists('formatMilliseconds')) {
    function formatMilliseconds($seconds)
    {
        $hours = 0;
        $milliseconds = str_replace("0.", '', $seconds - floor($seconds));
        if ($seconds > 3600) {
            $hours = floor($seconds / 3600);
        }
        $seconds = $seconds % 3600;
        return str_pad($hours, 2, '0', STR_PAD_LEFT)
        . gmdate(':i:s', $seconds)
        . ($milliseconds ? ".$milliseconds" : '');
    }
}

if (!function_exists('isModule')) {
    function isModule() {
        $route = Route::current();
        $isModule = explode('\\' , $route->getActionName());
        if($isModule['1'] == 'Modules') {
            return $isModule['2'].'::';
        }
        return '';
    }
}

if (!function_exists('dashboard_box')) {
    function dashboard_box($bg, $icon, $text, $number)
    {
        $str  = '<div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">';
        $str .= '<div class="info-box">';
        $str .= '<span class="info-box-icon '.$bg.'">';
        $str .= '<i class="fa fa-'.$icon.'"></i>';
        $str .= '</span>';
        $str .= '<div class="info-box-content">';
        $str .= '<span class="info-box-text">'. $text .'</span>';
        $str .= '<span class="info-box-number">'. $number .'</span>';
        $str .= '</div>';
        $str .= '</div>';
        $str .= '</div>';
        return $str;
    }
}
if (!function_exists('getWeekdays')) {
    function getWeekdays($key){
        $days = array(
            "sat" => "السبت",
            "sun" => "الأحد",
            "mon" => "الاثنين",
            "tue" => "الثلاثاء",
            "wed" => "الأربعاء",      
            "thu" => "الخميس",
            "fri" => "الجمعة"
            );
        return $days[$key];
    }
}
if (!function_exists('getSpaceEquipment')) {
    function getSpaceEquipment($equipment){
        $settings = unserialize(file_get_contents(base_path('./resources/settings.bin')));
        return $settings['space_equipment'][$equipment];
    }
}
if (!function_exists('getReportType')) {
    function getReportType($key){
        $type = [ 'video' => 'الفيديو', 'visual expression' => 'التعبير البصري', 'music' => 'الموسيقا و الصوت' ];
        return $type[$key];
    }
}
