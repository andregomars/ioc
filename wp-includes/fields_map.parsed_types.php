<?php return array (
  '' => 
  array (
  ),
  'ioc_wfu_log' => 
  array (
    'action' => 
    array (
      'type' => 'VARCHAR(20)',
    ),
    'blogid' => 
    array (
      'type' => 'int',
    ),
    'date_from' => 
    array (
      'type' => 'DATETIME',
    ),
    'date_to' => 
    array (
      'type' => 'DATETIME',
    ),
    'filedata' => 
    array (
      'type' => 'TEXT',
    ),
    'filehash' => 
    array (
      'type' => 'VARCHAR(100)',
    ),
    'filepath' => 
    array (
      'type' => 'TEXT',
    ),
    'filesize' => 
    array (
      'type' => 'int',
    ),
    'idlog' => 
    array (
      'type' => 'primary_id',
    ),
    'linkedto' => 
    array (
      'type' => 'int',
    ),
    'pageid' => 
    array (
      'type' => 'int',
    ),
    'sessionid' => 
    array (
      'type' => 'VARCHAR(40)',
    ),
    'sid' => 
    array (
      'type' => 'VARCHAR(10)',
    ),
    'uploadid' => 
    array (
      'type' => 'VARCHAR(20)',
    ),
    'uploadtime' => 
    array (
      'type' => 'int',
    ),
    'uploaduserid' => 
    array (
      'type' => 'int',
    ),
    'userid' => 
    array (
      'type' => 'int',
    ),
  ),
  'ioc_wfu_userdata' => 
  array (
    'date_from' => 
    array (
      'type' => 'DATETIME',
    ),
    'date_to' => 
    array (
      'type' => 'DATETIME',
    ),
    'iduserdata' => 
    array (
      'type' => 'primary_id',
    ),
    'property' => 
    array (
      'type' => 'VARCHAR(100)',
    ),
    'propkey' => 
    array (
      'type' => 'int',
    ),
    'propvalue' => 
    array (
      'type' => 'TEXT',
    ),
    'uploadid' => 
    array (
      'type' => 'VARCHAR(20)',
    ),
  ),
  'ioc_wfu_dbxqueue' => 
  array (
    'fileid' => 
    array (
      'type' => 'int',
    ),
    'iddbxqueue' => 
    array (
      'type' => 'primary_id',
    ),
    'jobid' => 
    array (
      'type' => 'VARCHAR(10)',
    ),
    'priority' => 
    array (
      'type' => 'int',
    ),
    'start_time' => 
    array (
      'type' => 'int',
    ),
    'status' => 
    array (
      'type' => 'int',
    ),
  ),
  'ioc_gmp_modules' => 
  array (
    'active' => 
    array (
      'type' => 'int',
    ),
    'code' => 
    array (
      'type' => 'nvarchar',
    ),
    'description' => 
    array (
      'type' => 'nvarchar',
    ),
    'ex_plug_dir' => 
    array (
      'type' => 'nvarchar',
    ),
    'has_tab' => 
    array (
      'type' => 'int',
    ),
    'id' => 
    array (
      'type' => 'primary_id',
    ),
    'label' => 
    array (
      'type' => 'nvarchar',
    ),
    'params' => 
    array (
      'type' => 'nvarchar',
    ),
    'type_id' => 
    array (
      'type' => 'int',
    ),
  ),
  'ioc_gmp_modules_type' => 
  array (
    'id' => 
    array (
      'type' => 'primary_id',
    ),
    'label' => 
    array (
      'type' => 'nvarchar',
    ),
  ),
  'ioc_gmp_options' => 
  array (
    'cat_id' => 
    array (
      'type' => 'int',
    ),
    'code' => 
    array (
      'type' => 'nvarchar',
    ),
    'description' => 
    array (
      'type' => 'nvarchar',
    ),
    'htmltype_id' => 
    array (
      'type' => 'int',
    ),
    'id' => 
    array (
      'type' => 'primary_id',
    ),
    'label' => 
    array (
      'type' => 'nvarchar',
    ),
    'params' => 
    array (
      'type' => 'nvarchar',
    ),
    'sort_order' => 
    array (
      'type' => 'int',
    ),
    'value' => 
    array (
      'type' => 'nvarchar',
    ),
    'value_type' => 
    array (
      'type' => 'nvarchar',
    ),
  ),
  'ioc_gmp_options_categories' => 
  array (
    'id' => 
    array (
      'type' => 'primary_id',
    ),
    'label' => 
    array (
      'type' => 'nvarchar',
    ),
  ),
  'ioc_gmp_maps' => 
  array (
    'create_date' => 
    array (
      'type' => 'date',
    ),
    'description' => 
    array (
      'type' => 'nvarchar',
    ),
    'html_options' => 
    array (
      'type' => 'nvarchar',
    ),
    'id' => 
    array (
      'type' => 'primary_id',
    ),
    'params' => 
    array (
      'type' => 'nvarchar',
    ),
    'title' => 
    array (
      'type' => 'nvarchar',
    ),
  ),
  'ioc_gmp_markers' => 
  array (
    'address' => 
    array (
      'type' => 'nvarchar',
    ),
    'animation' => 
    array (
      'type' => 'int',
    ),
    'coord_x' => 
    array (
      'type' => 'nvarchar',
    ),
    'coord_y' => 
    array (
      'type' => 'nvarchar',
    ),
    'create_date' => 
    array (
      'type' => 'date',
    ),
    'description' => 
    array (
      'type' => 'nvarchar',
    ),
    'icon' => 
    array (
      'type' => 'int',
    ),
    'id' => 
    array (
      'type' => 'primary_id',
    ),
    'map_id' => 
    array (
      'type' => 'int',
    ),
    'marker_group_id' => 
    array (
      'type' => 'int',
    ),
    'params' => 
    array (
      'type' => 'nvarchar',
    ),
    'sort_order' => 
    array (
      'type' => 'int',
    ),
    'title' => 
    array (
      'type' => 'nvarchar',
    ),
    'user_id' => 
    array (
      'type' => 'int',
    ),
  ),
  'ioc_gmp_icons' => 
  array (
    'description' => 
    array (
      'type' => 'nvarchar',
    ),
    'id' => 
    array (
      'type' => 'primary_id',
    ),
    'path' => 
    array (
      'type' => 'nvarchar',
    ),
    'title' => 
    array (
      'type' => 'nvarchar',
    ),
  ),
  'ioc_gmp_marker_groups' => 
  array (
    'description' => 
    array (
      'type' => 'nvarchar',
    ),
    'id' => 
    array (
      'type' => 'primary_id',
    ),
    'params' => 
    array (
      'type' => 'nvarchar',
    ),
    'sort_order' => 
    array (
      'type' => 'int',
    ),
    'title' => 
    array (
      'type' => 'nvarchar',
    ),
  ),
  'ioc_gmp_usage_stat' => 
  array (
    'UNIQUE' => 
    array (
      'type' => 'INDEX',
    ),
    'code' => 
    array (
      'type' => 'nvarchar',
    ),
    'id' => 
    array (
      'type' => 'primary_id',
    ),
    'modify_timestamp' => 
    array (
      'type' => 'TIMESTAMP',
    ),
    'spent_time' => 
    array (
      'type' => 'int',
    ),
    'visits' => 
    array (
      'type' => 'int',
    ),
  ),
  'ioc_wpgmza' => 
  array (
    'address' => 
    array (
      'type' => 'nvarchar',
    ),
    'anim' => 
    array (
      'type' => 'nvarchar',
    ),
    'approved' => 
    array (
      'type' => 'int',
    ),
    'category' => 
    array (
      'type' => 'nvarchar',
    ),
    'description' => 
    array (
      'type' => 'nvarchar',
    ),
    'did' => 
    array (
      'type' => 'nvarchar',
    ),
    'icon' => 
    array (
      'type' => 'nvarchar',
    ),
    'id' => 
    array (
      'type' => 'primary_id',
    ),
    'infoopen' => 
    array (
      'type' => 'nvarchar',
    ),
    'lat' => 
    array (
      'type' => 'nvarchar',
    ),
    'link' => 
    array (
      'type' => 'nvarchar',
    ),
    'lng' => 
    array (
      'type' => 'nvarchar',
    ),
    'map_id' => 
    array (
      'type' => 'int',
    ),
    'other_data' => 
    array (
      'type' => 'LONGTEXT',
    ),
    'pic' => 
    array (
      'type' => 'nvarchar',
    ),
    'retina' => 
    array (
      'type' => 'int',
    ),
    'title' => 
    array (
      'type' => 'nvarchar',
    ),
    'type' => 
    array (
      'type' => 'int',
    ),
  ),
  'ioc_wpgmza_polygon' => 
  array (
    'fillcolor' => 
    array (
      'type' => 'VARCHAR(7)',
    ),
    'id' => 
    array (
      'type' => 'primary_id',
    ),
    'innerpolydata' => 
    array (
      'type' => 'LONGTEXT',
    ),
    'linecolor' => 
    array (
      'type' => 'VARCHAR(7)',
    ),
    'lineopacity' => 
    array (
      'type' => 'VARCHAR(7)',
    ),
    'link' => 
    array (
      'type' => 'VARCHAR(700)',
    ),
    'map_id' => 
    array (
      'type' => 'int',
    ),
    'ohfillcolor' => 
    array (
      'type' => 'VARCHAR(7)',
    ),
    'ohlinecolor' => 
    array (
      'type' => 'VARCHAR(7)',
    ),
    'ohopacity' => 
    array (
      'type' => 'VARCHAR(3)',
    ),
    'opacity' => 
    array (
      'type' => 'VARCHAR(3)',
    ),
    'polydata' => 
    array (
      'type' => 'LONGTEXT',
    ),
    'polyname' => 
    array (
      'type' => 'VARCHAR(100)',
    ),
    'title' => 
    array (
      'type' => 'VARCHAR(250)',
    ),
  ),
  'ioc_wpgmza_polylines' => 
  array (
    'id' => 
    array (
      'type' => 'primary_id',
    ),
    'linecolor' => 
    array (
      'type' => 'VARCHAR(7)',
    ),
    'linethickness' => 
    array (
      'type' => 'VARCHAR(3)',
    ),
    'map_id' => 
    array (
      'type' => 'int',
    ),
    'opacity' => 
    array (
      'type' => 'VARCHAR(3)',
    ),
    'polydata' => 
    array (
      'type' => 'LONGTEXT',
    ),
    'polyname' => 
    array (
      'type' => 'VARCHAR(100)',
    ),
  ),
  'ioc_wpgmza_categories' => 
  array (
    'active' => 
    array (
      'type' => 'TINYINT(1)',
    ),
    'category_icon' => 
    array (
      'type' => 'VARCHAR(700)',
    ),
    'category_name' => 
    array (
      'type' => 'VARCHAR(50)',
    ),
    'id' => 
    array (
      'type' => 'primary_id',
    ),
    'retina' => 
    array (
      'type' => 'TINYINT(1)',
    ),
  ),
  'ioc_wpgmza_category_maps' => 
  array (
    'cat_id' => 
    array (
      'type' => 'INT(11)',
    ),
    'id' => 
    array (
      'type' => 'primary_id',
    ),
    'map_id' => 
    array (
      'type' => 'INT(11)',
    ),
  ),
  'ioc_wpgmza_maps' => 
  array (
    'active' => 
    array (
      'type' => 'INT(1)',
    ),
    'alignment' => 
    array (
      'type' => 'INT(10)',
    ),
    'bicycle' => 
    array (
      'type' => 'INT(10)',
    ),
    'dbox' => 
    array (
      'type' => 'INT(10)',
    ),
    'dbox_width' => 
    array (
      'type' => 'nvarchar',
    ),
    'default_marker' => 
    array (
      'type' => 'nvarchar',
    ),
    'default_to' => 
    array (
      'type' => 'VARCHAR(700)',
    ),
    'directions_enabled' => 
    array (
      'type' => 'INT(10)',
    ),
    'filterbycat' => 
    array (
      'type' => 'TINYINT(1)',
    ),
    'fusion' => 
    array (
      'type' => 'VARCHAR(100)',
    ),
    'id' => 
    array (
      'type' => 'primary_id',
    ),
    'kml' => 
    array (
      'type' => 'VARCHAR(700)',
    ),
    'listmarkers' => 
    array (
      'type' => 'INT(10)',
    ),
    'listmarkers_advanced' => 
    array (
      'type' => 'INT(10)',
    ),
    'map_height' => 
    array (
      'type' => 'nvarchar',
    ),
    'map_height_type' => 
    array (
      'type' => 'VARCHAR(3)',
    ),
    'map_start_lat' => 
    array (
      'type' => 'nvarchar',
    ),
    'map_start_lng' => 
    array (
      'type' => 'nvarchar',
    ),
    'map_start_location' => 
    array (
      'type' => 'nvarchar',
    ),
    'map_start_zoom' => 
    array (
      'type' => 'INT(10)',
    ),
    'map_title' => 
    array (
      'type' => 'nvarchar',
    ),
    'map_width' => 
    array (
      'type' => 'nvarchar',
    ),
    'map_width_type' => 
    array (
      'type' => 'VARCHAR(3)',
    ),
    'mass_marker_support' => 
    array (
      'type' => 'INT(10)',
    ),
    'order_markers_by' => 
    array (
      'type' => 'INT(10)',
    ),
    'order_markers_choice' => 
    array (
      'type' => 'INT(10)',
    ),
    'other_settings' => 
    array (
      'type' => 'nvarchar',
    ),
    'show_user_location' => 
    array (
      'type' => 'INT(3)',
    ),
    'styling_enabled' => 
    array (
      'type' => 'INT(10)',
    ),
    'styling_json' => 
    array (
      'type' => 'nvarchar',
    ),
    'traffic' => 
    array (
      'type' => 'INT(10)',
    ),
    'type' => 
    array (
      'type' => 'INT(10)',
    ),
    'ugm_access' => 
    array (
      'type' => 'INT(10)',
    ),
    'ugm_category_enabled' => 
    array (
      'type' => 'TINYINT(1)',
    ),
    'ugm_enabled' => 
    array (
      'type' => 'INT(10)',
    ),
  ),
  'ioc_leafletmapsmarker_markers' => 
  array (
    '6)' => 
    array (
      'type' => 'NOT',
    ),
    'address' => 
    array (
      'type' => 'nvarchar',
    ),
    'basemap' => 
    array (
      'type' => 'nvarchar',
    ),
    'controlbox' => 
    array (
      'type' => 'int',
    ),
    'createdby' => 
    array (
      'type' => 'nvarchar',
    ),
    'createdon' => 
    array (
      'type' => 'date',
    ),
    'gpx_panel' => 
    array (
      'type' => 'int',
    ),
    'gpx_url' => 
    array (
      'type' => 'nvarchar',
    ),
    'icon' => 
    array (
      'type' => 'nvarchar',
    ),
    'id' => 
    array (
      'type' => 'primary_id',
    ),
    'kml_timestamp' => 
    array (
      'type' => 'date',
    ),
    'lat' => 
    array (
      'type' => 'decimal(9',
    ),
    'layer' => 
    array (
      'type' => 'nvarchar',
    ),
    'lon' => 
    array (
      'type' => 'decimal(9',
    ),
    'mapheight' => 
    array (
      'type' => 'int',
    ),
    'mapwidth' => 
    array (
      'type' => 'int',
    ),
    'mapwidthunit' => 
    array (
      'type' => 'nvarchar',
    ),
    'markername' => 
    array (
      'type' => 'nvarchar',
    ),
    'openpopup' => 
    array (
      'type' => 'int',
    ),
    'overlays_custom' => 
    array (
      'type' => 'int',
    ),
    'overlays_custom2' => 
    array (
      'type' => 'int',
    ),
    'overlays_custom3' => 
    array (
      'type' => 'int',
    ),
    'overlays_custom4' => 
    array (
      'type' => 'int',
    ),
    'panel' => 
    array (
      'type' => 'int',
    ),
    'popuptext' => 
    array (
      'type' => 'nvarchar',
    ),
    'updatedby' => 
    array (
      'type' => 'nvarchar',
    ),
    'updatedon' => 
    array (
      'type' => 'date',
    ),
    'wms' => 
    array (
      'type' => 'int',
    ),
    'wms10' => 
    array (
      'type' => 'int',
    ),
    'wms2' => 
    array (
      'type' => 'int',
    ),
    'wms3' => 
    array (
      'type' => 'int',
    ),
    'wms4' => 
    array (
      'type' => 'int',
    ),
    'wms5' => 
    array (
      'type' => 'int',
    ),
    'wms6' => 
    array (
      'type' => 'int',
    ),
    'wms7' => 
    array (
      'type' => 'int',
    ),
    'wms8' => 
    array (
      'type' => 'int',
    ),
    'wms9' => 
    array (
      'type' => 'int',
    ),
    'zoom' => 
    array (
      'type' => 'int',
    ),
  ),
  'ioc_leafletmapsmarker_layers' => 
  array (
    '6)' => 
    array (
      'type' => 'NOT',
    ),
    'address' => 
    array (
      'type' => 'nvarchar',
    ),
    'basemap' => 
    array (
      'type' => 'nvarchar',
    ),
    'clustering' => 
    array (
      'type' => 'int',
    ),
    'controlbox' => 
    array (
      'type' => 'int',
    ),
    'createdby' => 
    array (
      'type' => 'nvarchar',
    ),
    'createdon' => 
    array (
      'type' => 'date',
    ),
    'gpx_panel' => 
    array (
      'type' => 'int',
    ),
    'gpx_url' => 
    array (
      'type' => 'nvarchar',
    ),
    'id' => 
    array (
      'type' => 'primary_id',
    ),
    'layerviewlat' => 
    array (
      'type' => 'decimal(9',
    ),
    'layerviewlon' => 
    array (
      'type' => 'decimal(9',
    ),
    'layerzoom' => 
    array (
      'type' => 'int',
    ),
    'listmarkers' => 
    array (
      'type' => 'int',
    ),
    'mapheight' => 
    array (
      'type' => 'int',
    ),
    'mapwidth' => 
    array (
      'type' => 'int',
    ),
    'mapwidthunit' => 
    array (
      'type' => 'nvarchar',
    ),
    'mlm_filter' => 
    array (
      'type' => 'int',
    ),
    'mlm_filter_details' => 
    array (
      'type' => 'nvarchar',
    ),
    'multi_layer_map' => 
    array (
      'type' => 'int',
    ),
    'multi_layer_map_list' => 
    array (
      'type' => 'nvarchar',
    ),
    'name' => 
    array (
      'type' => 'nvarchar',
    ),
    'overlays_custom' => 
    array (
      'type' => 'int',
    ),
    'overlays_custom2' => 
    array (
      'type' => 'int',
    ),
    'overlays_custom3' => 
    array (
      'type' => 'int',
    ),
    'overlays_custom4' => 
    array (
      'type' => 'int',
    ),
    'panel' => 
    array (
      'type' => 'int',
    ),
    'updatedby' => 
    array (
      'type' => 'nvarchar',
    ),
    'updatedon' => 
    array (
      'type' => 'date',
    ),
    'wms' => 
    array (
      'type' => 'int',
    ),
    'wms10' => 
    array (
      'type' => 'int',
    ),
    'wms2' => 
    array (
      'type' => 'int',
    ),
    'wms3' => 
    array (
      'type' => 'int',
    ),
    'wms4' => 
    array (
      'type' => 'int',
    ),
    'wms5' => 
    array (
      'type' => 'int',
    ),
    'wms6' => 
    array (
      'type' => 'int',
    ),
    'wms7' => 
    array (
      'type' => 'int',
    ),
    'wms8' => 
    array (
      'type' => 'int',
    ),
    'wms9' => 
    array (
      'type' => 'int',
    ),
  ),
)
 ?>