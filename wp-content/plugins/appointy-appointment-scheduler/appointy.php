<?php
/*
Plugin Name: Appointy - Appointment Scheduler.
Plugin URI: http://www.appointy.com/wordpress/
Description: This plugin shows your free time slot on your blog and allows you to book appointments with your clients 24x7x365. Very easy Ajax interface. Easy to setup and can be controlled completely from powerful admin area.
Version: 2.31
Author: Appointy.com
Author URI: http://www.appointy.com
*/

//define('WP_DEBUG', true);
//error_reporting( E_ALL );
define('APPOINTYPATH', get_option('siteurl').'/wp-content/plugins/appointy-appointment-scheduler');

$appointy_installed = true;
$appointy_calendar_privileges = 0;
$iFrameVal = "<iframe src=http://demo.appointy.com/?isGadget=1 width=100% height=550px scrolling=auto frameborder=0></iframe>";

//Needs an unbranded version? Upgrade to a PRO membership for just $19.99/month. Read more here http://help.appointy.com/entries/20165487-Can-you-unbrand-Appointy-for-me-

$poweredby = "<div style='font-size:11px;'>Powered by <a href='http://www.appointy.com/?isGadget=2&utm_source=wordpress&utm_medium=plugin&utm_campaign=wp-plugin' target = '_Blank' alt='Online Appointment Scheduling Software'>Appointy - Online Appointment Scheduling Software</a></div>";

add_action('init', 'appointy_calendar_init');
add_action('widgets_init', 'widget_init_appointy');
add_filter('the_content','appointy_insert');

function appointy_insert($content)
{
  if (preg_match('{APPOINTY}',$content))
    {
      $content = str_replace('{APPOINTY}',appointy(),$content);
    }
	//echo $content;
  return $content;
}

function appointy()
{
   global  $userdata, $table_prefix, $wpdb, $appointy_installed, $poweredby;
    get_currentuserinfo();
  //  $user_login = $userdata->user_login;
	$str='';
  if( !appointy_calendar_installed() )
		$appointy_installed = appointy_calendar_install();
		//echo "-->" . $appointy_installed;
    
    if( !$appointy_installed )
    {
		echo "PLUGIN NOT CORRECTLY INSTALLED, PLEASE CHECK ALL INSTALL PROCEDURE!";
		return;
	}
	    $query = "
			SELECT code AS code
			FROM ".$table_prefix."appointy_calendar	LIMIT 1
		";
		//echo $query;
		$code = $wpdb->get_var( $query );
		$code .= $poweredby;
		
	//}
	?>
	
	<?php
    $str.='<div class="wrap">';
	if( $code === null )
	{
		$str.= '<h4>You don\'t have appointy Calendar, please set code in Settings menu.</h4>';
	}
	else
	{
		
				
		$str.='<center>';
		
		$str.='<div id="CalendarDiv">';
		?><?php
		 $str.= $code;
		  ?>
		<?php 
		$str.='</div>';
		 
		 
		$str.='</center>';
	 
	}
	?>
	<?php
    $str.='</div>';
	
	return $str;
	
	
}


// ************Code to render Appointy button in the sidebar*****************
// ************START***********************

function widget_init_appointy() {
  if (!function_exists('wp_register_sidebar_widget'))
  	return;
	wp_register_sidebar_widget(
    '108',        // your unique widget id
    'Appointy',          // widget name
    'widget_calendar_appointy',  // callback function
    array(                  // options
        'description' => 'It places a cool schedule now button on the sidebar of your website.'
    ));
}

function widget_calendar_appointy($args) {
   extract($args);
   echo $before_widget;
   echo $before_title . 'Schedule Now' . $after_title;
   echo '<a href="' .appointy_widget_init()."/?utm_source=wordpress&utm_medium=plugin&utm_campaign=wp-plugin". '" target="_blank"><img src="http://appointy.com/Images/scheduleme.png" alt="" border="0" /></a>';
   echo $after_widget;
 }

function appointy_widget_init() {
	global $table_prefix, $wpdb;
	if( !appointy_calendar_install() )
		{
			echo "PLUGIN NOT CORRECTLY INSTALLED, PLEASE CHECK ALL INSTALL PROCEDURE!";
			return;
		}
			$query = "
				SELECT code AS code
				FROM ".$table_prefix."appointy_calendar	LIMIT 1
			";
			$code = $wpdb->get_var( $query );
			return appointy_get_booking_url($code);
			
}

	 
function appointy_get_booking_url($codeURL)
{
 $bookingURL = preg_match("/http:\/\/(.*).com/", $codeURL, $matches);
 if ($bookingURL = true)
 {
 $bookingURL = htmlentities($matches['0']);
 }
 return $bookingURL;
}


//******************* WIDGET CODE ENDS HERE **************************


function appointy_calendar_init()
{		
	global $appointy_calendar_privileges, $table_prefix, $wpdb, $appointy_path, $appointy_default, $appointy_installed;
 	add_action('admin_menu', 'appointy_calendar_config_page');
}

function appointy_calendar_config_page() 
{

	if ( function_exists('add_submenu_page') )
	{
		add_menu_page('appointy Calendar', 'Appointy Calendar', 8, __FILE__, 'appointy_calendar_main_page');
		//add_submenu_page(__FILE__, 'Settings', 'Settings', $appointy_calendar_privileges, 'maintenance', 'appointy_calendar_manage_page');
		//add_submenu_page(__FILE__, 'Admin Settings', 'Admin Settings', 8, 'admin_maitenance', 'appointy_calendar_admin_manage_page');
	}
}

function appointy_calendar_main_page()
{
	global $appointy_default, $userdata, $table_prefix, $wpdb, $appointy_installed, $iFrameVal;
    get_currentuserinfo();
    
    if( !appointy_calendar_installed() )
		$appointy_installed = appointy_calendar_install();
	
    if( !$appointy_installed )
    {
		echo "PLUGIN NOT CORRECTLY INSTALLED, PLEASE CHECK ALL INSTALL PROCEDURE!";
		return;
	}
	?>
	<div class="wrap">
	<?php
	$valid = true;

	$queryS = "select * from ".$table_prefix."appointy_calendar limit 1";
	$d1 = $wpdb->get_var( $queryS );
	if( $d1 === null )
		{
			$query ="
				INSERT INTO ".$table_prefix."appointy_calendar (code)
				VALUES ('". $iFrameVal ."')
			";
			$wpdb->query( $query );
		}
	else
		{
			$query = "SELECT code AS code FROM ".$table_prefix."appointy_calendar	LIMIT 1";
			$iFrameVal = $wpdb->get_var( $query );
		}
	
		
	if( isset($_POST["set"]) AND $_POST["set"] == "Update" )
	{
		
		
			
		if( !appointy_calendar_code( $_POST["code"] ) )
			$valid = false;
		else
		{
			// New Code Start
			$newCode = '';
			if( isset($_POST["language-selected"])) 
			{
				$newCode = change_fpac_lanugae($_POST['language-selected'], $_POST["code"]);
			}
			else
			{
				$newCode = 	$_POST["code"];
			}
		
			// New Code End
		
			$query ="Update ".$table_prefix."appointy_calendar set code = '".$newCode."'";// where calendar_id = " & $d1 ->calendar_id;
			
			$wpdb->query( $query );
			// $iFrameVal = str_replace("\\", "", ($_POST["code"]));
			$iFrameVal = str_replace("\\", "", $newCode);
			
		}
		
	}
	
	if( isset( $_GET["ui"]) and $_GET["ui"] == "true" )
	{
		global $wpdb;
		$table = $wpdb->prefix."appointy_calendar";
		$wpdb->query("DROP TABLE IF EXISTS $table");
		
		delete_option( 'appointy_calendar_privileges' ); //Removing option from database...
		
		$installed = appointy_calendar_installed();
		
		if( !$installed ) {
			echo "PLUGIN UNINSTALLED. NOW DE-ACTIVATE PLUGIN.<br />";
			echo " <a href=plugins.php>CLICK HERE</a>";
			return;
			}
		else
		{
			echo "PROBLEMS WITH UNINSTALL FUNCTION.";
		}
			
	}
	
	// Check for language in fullpage code
		 $sel_lang_option_value = getLanguageValue(getLanguageCodeFromFpc($iFrameVal));
	
	?>

	<div style="margin-bottom:20px;"><h2>Appointy Calendar</h2></div>
	<div>
	<div style="float:left;">
	<!--<img src="<?php //echo APPOINTYPATH; ?>/calendar.png" border="0" />-->
	<img src="<?php echo APPOINTYPATH; ?>/singlePageCalendar.gif" border="0" />
	<br /><br />

	<span style="float:left;width:400px;padding-left:20px;">
	<p><b>Don't have an account on Appointy?</b></p>
	<a href ="http://www.appointy.com/newweb/quickUserSignUp.aspx?isgadget=2&utm_source=wordpress&utm_medium=plugin&utm_campaign=wp-plugin" target="_blank" class="button">&nbsp;&nbsp;Register Now. It's Free &raquo;&nbsp;&nbsp;</a><br />
	<br />
	</span></div>	
	
	<div style="float:left;width:400px;padding-left:20px;" >
    <form action="<?php echo $_SERVER["PHP_SELF"]."?page=".$_GET["page"]; ?>" method="POST">
	  <p><b style="color:#000099">STEP &raquo; 1 Enter your Appointy Calendar Code</b><br />
	    <span style="font-size:11px;">Don't have appointy username? Click here to register free.</span><br /> 
        <span style="font-size:11px;">Change "demo.appointy.com" to "{yourusername}.appointy.com"<br />
        where {yourusername} is your username on Appointy.com <br />
        </span><br />
        <textarea type ="text" name="code" rows="3" cols="60"><?php echo $iFrameVal ?></textarea>
      </p>
	  <p>
			Select language your customer speak
			<br/>
			<select name="language-selected">
				<?php
					echo createLanguageSelection($sel_lang_option_value);
				?>
			</select>
			<br/>
			<small style="color:rgba(0,0,0,0.7)">By default, the calendar would render in the above selected language. Go to settings in Appointy admin area to add multiple languages.</small>
		</p>
	  <p><input type="submit" name="set" value="Update" /></p>
	</form>
	<p><b style="color:#000099">STEP &raquo; 2 Create a new page. </b><br />
	  Goto &quot;<strong>Write</strong>&quot; --&gt; &quot;<strong>Write Page</strong>&quot;. Enter a<strong> Title</strong> e.g. &quot;Schedule an appointment&quot; (This would be shown as a link on your page. So make sure you chose the right title) and in <strong>Page Content </strong>write {APPOINTY} (including brackets). See preview. <br /><br />Note: If it overlaps your sidebar then create a new template from your theme without sidebar and use it for Appointy page. <a href=http://blog.appointy.com/tip/solution-appointy-wordpress-plugin-overlays-sidebar target=_blank >Click here</a> to see step by step instructions.</p>
	<p><b style="color:#000099">STEP &raquo; 3 You are done. Now manage Appointments and clients from admin area easily. </b><br />
	  You are all done. Now test your blog. Appointy is easy to use and your clients would love scheduling with you. If you want to change your business hours, block days or times, add staff or service, approve appointment etc then click the link below and login to your powerful admin area on Appointy. <br />
	  <br />
	  <a href =<?php echo appointy_get_admin_url(); ?> target="_blank" class="button">&nbsp;&nbsp; Goto Admin Area &raquo;&nbsp;&nbsp;</a>		    </p>
	<p><br />
		<p>Uninstall Appointy Plugin: <a href="admin.php?page=appointy-appointment-scheduler\appointy.php&ui=true">UNINSTALL</a></p>
	  <br />
	  <br />
	
	</p>
	
	</div>
	</div>
	<div>
	<div style="clear:both"></div>
	
	<?php
}

// New Code Start

function getLanguageCodeArray(){
	$language['default'] = 'default';
	$language['bulgarian'] = 'bg-BG'; //
	$language['chinese'] = 'zh-CN';
	$language['chinese_(Traditional)'] = 'zh-Hant';
	$language['croatian'] = 'hr';
	$language['czech_(Republic)'] = 'cs';
	$language['danish'] = 'da-DK';
	$language['dutch'] = 'nl-NL';
	$language['english_(US)'] = 'en-US';
	$language['english_(UK)'] = 'en-GB';
	$language['english_(Australia)'] = 'en-AU';
	$language['estonian'] = 'et-EE';
	$language['french'] = 'fr-FR' ;
	$language['finnish'] = 'fi'; //
	$language['german'] = 'de-DE' ; //
	$language['greek'] = 'el-GR';
	$language['hungarian'] = 'hu-HU';
	$language['italian'] = 'it-IT' ; //
	$language['japanese'] = 'ja';
	$language['lithuanian'] = 'lt-LT';
	$language['latvian'] = 'lv-LV';
	$language['nynorsk'] = 'no'; //*
	$language['portuguese'] = 'pt'; //
	$language['portuguese_(Brazil)'] = 'pt-BR';
	$language['polish'] = 'pl-PL'; //
	$language['russian'] = 'ru-RU'; //
	$language['romanian'] = 'ro-RO'; //
	$language['spanish'] = 'es'; //
	$language['slovenian'] = 'sl-SI';
	$language['serbian_(Cyrilic)'] = 'sr-Cyrl-BA';
	$language['serbian_(Latin)'] = 'sr';
	$language['slovak'] = 'sk' ; //
	$language['swedish'] = 'sv-SE';
	$language['turkish'] = 'tr-TR';
	
	
	
	return $language;
}

function getLanguageCode($language)
{
	$languageCode = getLanguageCodeArray();
	
	$str = '/ChangeLanguage.aspx?lan=';
	// Return default if no key is exist
	$lanValue = isset($languageCode[$language]) ? $languageCode[$language] :'default';
	$lanValue = $str.$lanValue;
	return $lanValue;
	
}

function getLanguageValueArray(){
	$language['default'] = 'default';
	$language['bg-BG'] = 'bulgarian'; //
	$language['zh-CN'] = 'chinese';
	$language['zh-Hant'] = 'chinese_(Traditional)';
	$language['hr'] = 'croatian';
	$language['cs'] = 'czech_(Republic)';
	$language['da-DK'] = 'danish';
	$language['nl-NL'] = 'dutch';
	$language['en-US'] = 'english_(US)';
	$language['en-GB'] = 'english_(UK)';
	$language['en-AU'] = 'english_(Australia)';
	$language['et-EE'] = 'estonian';
	$language['fr-FR'] = 'french';
	$language['fi'] = 'finnish'; //
	$language['de-DE'] = 'german'; //
	$language['el-GR'] = 'greek';
	$language['hu-HU'] = 'hungarian';
	$language['it-IT'] = 'italian'; //
	$language['ja'] = 'japanese';
	$language['lt-LT'] = 'lithuanian';
	$language['lv-LV'] = 'latvian';
	$language['no'] = 'nynorsk'; //*
	$language['pt'] = 'portuguese'; //
	$language['pt-BR'] = 'portuguese_(Brazil)';
	$language['pl-PL'] = 'polish'; //
	$language['ru-RU'] = 'russian'; //
	$language['ro-RO'] = 'romanian'; //
	$language['es'] = 'spanish'; //
	$language['sl-SI'] = 'slovenian';
	$language['sr-Cyrl-BA'] = 'serbian_(Cyrilic)';
	$language['sr'] = 'serbian_(Latin)';
	$language['sk'] = 'slovak'; //
	$language['sv-SE'] = 'swedish';
	$language['tr-TR'] = 'turkish';
	
	
	
	return $language;
}

function getLanguageValue($lan)
{
	$language = getLanguageValueArray();
	// Return default if no key is exist
	$lanValue = isset($language[$lan]) ? $language[$lan] :'default';
	return $lanValue;
	
}

function getLanguageCodeFromFpc($code){
	preg_match("/.appointy.com\/ChangeLanguage\.aspx\?lan\=(.*)\&isGadget=1/", $code, $output_array);
	$lanValue = '';
	if(count($output_array) > 1){
		$lanValue = $output_array[1];
	}
	return $lanValue;
}

function change_fpac_lanugae($language, $code)
{
	$newCode = $code;
	$languageCode = getLanguageCode($language);
	if(preg_match('(/ChangeLanguage.aspx)', $code))
	{
		$code = preg_replace("/.appointy.com(.*)\&isGadget=1/", ".appointy.com/?isGadget=1", $code);
		$newCode = $code;
	}
	// if language is set to default then do nothing
	// because code is already reset in previous step
	if($language != "default"){
		$codestr = preg_split('(\.appointy\.com\/\?)', $code);
		$newCode = $codestr[0].'\.appointy\.com'.$languageCode.'\&'.$codestr[1];
	}
    return $newCode;
}

function createLanguageSelection($selLang){
	// $language['default'] = 'default';
	// $temp = getLanguageCodeArray();
	// array_push($language, $temp);
	$language = getLanguageCodeArray();
	$str = '';
	foreach ($language as $key => $value) {
		# code...
		$str .= "<option value='".$key."'". ($selLang == $key?"selected":"").">".ucfirst(str_replace('_',' ',$key)).'</option>';
	}
	return $str;
}

// New Code End



function appointy_calendar_code( $code )
{
	if( strpos($code, "<iframe") === FALSE )
		return false;
	else
		return true;
}

function appointy_get_admin_url()
{
 global $iFrameVal;
 $adminURL = preg_match("/http:\/\/(.*).com/", $iFrameVal, $matches);
 if ($adminURL = true)
 {
 $adminURL = htmlentities($matches['0']);
 $adminURL = $adminURL .'/admin';
 }
 return $adminURL;
}



function appointy_calendar_installed()
{
	global $table_prefix, $wpdb;
	
	$query = "
		SHOW TABLES LIKE '".$table_prefix."appointy_calendar'
	";
	//echo $query;
	$install = $wpdb->get_var( $query );
	//echo "nemesh-->>" . $install;
	
	if( $install === NULL )
		return false;
	else
		return true;
}

function appointy_calendar_install()
{
	global $table_prefix, $wpdb;
	
	$query = "
		CREATE TABLE ".$table_prefix."appointy_calendar (
			calendar_id INT(11) NOT NULL auto_increment,
			code TEXT NOT NULL,
			PRIMARY KEY( calendar_id )
		)
	";
	$wpdb->query( $query );

	//Using option for appointy calendar plugin!
	add_option( "appointy_calendar_privileges", "2" );
	
	if( !appointy_calendar_installed() )
		return false;
	else
		return true;
}



?>