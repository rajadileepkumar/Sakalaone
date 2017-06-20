<?php

$cminds_plugin_config = array(
	'plugin-is-pro'				 => false,
	'plugin-has-addons'			 => TRUE,
	'plugin-version'			 => '2.5.8',
	'plugin-abbrev'				 => 'cmdm',
	'plugin-file'				 => CMDM_PLUGIN_FILE,
        'plugin-affiliate'               => '',
    'plugin-redirect-after-install'  => admin_url( 'admin.php?page=CMDM_admin_settings' ),
     'plugin-show-guide'                 => TRUE,
     'plugin-guide-text'                 => '    <div style="display:block">
        <ol>
         <li>Go to the plugin <strong>"Setting"</strong> and click on <strong>"Link to downloads frontend list"</strong></li>
         <li>Click on  <strong>"Manage My Downloads"</strong> button at the right side of the screen</li>
            <li>From the user dashboard click on <strong>Add New</strong> to upload your first download</li>
            <li>Fill up for form and upload your first download, make sure you mark the category.</li>
            <li><strong>View</strong> the download created</li>
            <li>In the <strong>Plugin Settings</strong> you can set the file extensions which are accepted, the default image and more.</li>
            <li>You can add or change category names from the <strong>Plugin Admin Menu</strong></li>
            <li><strong>Troubleshooting:</strong> Make sure that you are using Post name permalink structure in the WP Admin Settings -> Permalinks.</li>
            <li><strong>Troubleshooting:</strong> If post type archive does not show up or displays 404 then install Rewrite Rules Inspector plugin and use the Flush rules button.</li>
            <li><strong>Troubleshooting:</strong> If the settings cannot be saved eg. 403 Forbidden error shows up after pressed the Save button, then contact your hosting provider and ask for the restrictions for POST requests to the /wp-admin/admin.php.</li>        
        </ol>
    </div>',
     'plugin-guide-video-height'         => 240,
     'plugin-guide-videos'               => array(
          array( 'title' => 'Installation tutorial', 'video_id' => '159673805' ),
     ),
	'plugin-dir-path'			 => plugin_dir_path( CMDM_PLUGIN_FILE ),
	'plugin-dir-url'			 => plugin_dir_url( CMDM_PLUGIN_FILE ),
	'plugin-basename'			 => plugin_basename( CMDM_PLUGIN_FILE ),
	'plugin-icon'				 => '',
	'plugin-name'				 => 'CM Download Manager',
	'plugin-license-name'		 => 'CM Download Manager',
	'plugin-slug'				 => '',
	'plugin-short-slug'			 => 'cm-download-manager',
	'plugin-menu-item'			 => 'CMDM_downloads_menu',
	'plugin-textdomain'			 => 'cm-download-manager',
	'plugin-userguide-key'		 => '8-cm-download-manager',
	'plugin-store-url'			 => 'https://www.cminds.com/wordpress-plugins-library/downloadsmanager/',
	'plugin-support-url'		 => 'http://wordpress.org/support/plugin/cm-download-manager',
	'plugin-review-url'			 => 'http://wordpress.org/support/view/plugin-reviews/cm-download-manager',
	'plugin-changelog-url'		 => 'https://downloadsmanager.cminds.com/release-notes/',
	'plugin-licensing-aliases'	 => array( 'CM Download Manager' ),
	'plugin-compare-table'	 => '<div class="pricing-table" id="pricing-table">
                <ul>
                    <li class="heading">Current Edition</li>
                    <li class="price">$0.00</li>
                    <li class="noaction"><span>Free Download</span></li>
                   <li>Unlimited Downloads</li>
                    <li>Download Categories</li>
                    <li>Voting per each download</li>
                    <li>View count per each download</li>
                    <li>Support forum per each download</li>
                    <li>Internal Search</li>
                    <li>User Notifications</li>
                    <li>Only logged-in users can download</li>
                    <li>X</li>
                     <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                         <li class="price">$0.00</li>
                    <li class="noaction"><span>Free Download</span></li>
                </ul>

               <ul>
                    <li class="heading">Pro</li>
                    <li class="price">$39.00</li>
                    <li class="action"><a href="https://www.cminds.com/wordpress-plugins-library/downloadsmanager/" style="background-color:darkblue;" target="_blank">More Info</a> &nbsp;&nbsp;<a href="https://www.cminds.com/?edd_action=add_to_cart&download_id=1930&wp_referrer=https://www.cminds.com/checkout/&edd_options[price_id]=2" target="_blank">Buy Now</a></li>
                    <li>Unlimited Downloads</li>
                    <li>Download Categories</li>
                    <li>Voting per each download</li>
                    <li>View count per each download</li>
                    <li>Support forum per each download</li>
                    <li>Internal Search</li>
                    <li>User Notifications</li>
                    <li>All users can download</li>
                    <li>User Groups Permissions</li>
                    <li>Social Media Integration</li>
                    <li>Downloads can be Password Protected</li>
                    <li>Admin can define Upload Restriction</li>
                    <li>Admin can define View Restrictions</li>
                    <li>Shortcodes for downloads list</li>
                    <li>Integration with Store plugins using shortcodes</li>
                    <li>Multisite Support</li>
                    <li>Moderation Support</li>
                    <li>Gravatar Support</li>
                    <li>Widgets</li>
                    <li>Disclaimer Support</li>
                    <li>File Preview Option</li>
                    <li>Audio & Video Player Option</li>
                    <li>Customize Download Page</li>
                    <li>Customize Plugin Permalink</li>
                    <li>User Profile with all Downloads</li>
                    <li>Extended internal Search</li>
                    <li>Tiles, list & category view of downloads index</li>
                    <li>Social share widget</li>
                    <li>Log & Statistics</li>
                    <li>Second Level Navigation</li>
                    <li>Download Shortcodes in Post/Pages</li>
                    <li>Multiple File Upload</li>
                    <li>Automatic Zip Compression</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                       <li class="price">$39.00</li>
                   <li class="action"><a href="https://www.cminds.com/wordpress-plugins-library/downloadsmanager/" style="background-color:darkblue;" target="_blank">More Info</a> &nbsp;&nbsp;<a href="https://www.cminds.com/?edd_action=add_to_cart&download_id=1930&wp_referrer=https://www.cminds.com/checkout/&edd_options[price_id]=2" target="_blank">Buy Now</a></li>
                </ul>
                  <ul>
                    <li class="heading">Pro Client Zone</li>
                    <li class="price">$49.00</li>
                    <li class="action"><a href="https://www.cminds.com/wordpress-plugins-library/downloadsmanager/" style="background-color:darkblue;" target="_blank">More Info</a> &nbsp;&nbsp;<a href="https://www.cminds.com/?edd_action=add_to_cart&download_id=51133&wp_referrer=https://www.cminds.com/checkout/&edd_options[price_id]=1" target="_blank">Buy Now</a></li>
                    <li>Unlimited Downloads</li>
                    <li>Download Categories</li>
                    <li>Voting per each download</li>
                    <li>X</li>
                    <li>Support forum per each download</li>
                    <li>X</li>
                    <li>User Notifications</li>
                     <li>All users can download</li>
                   <li>User Groups Permissions</li>
                    <li>Social Media Integration</li>
                    <li>Downloads can be Password Protected</li>
                    <li>Admin can define Upload Restriction</li>
                    <li>Admin can define View Restrictions</li>
                    <li>Shortcodes for downloads list</li>
                    <li>X</li>
                    <li>Multisite Support</li>
                    <li>Moderation Support</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>File Preview Option</li>
                    <li>Audio & Video Player Option</li>
                    <li>X</li>
                    <li>Customize Plugin Permalink</li>
                    <li>X</li>
                    <li>Extended internal Search</li>
                    <li>X</li>
                    <li>X</li>
                    <li>Log & Statistics</li>
                    <li>Second Level Navigation</li>
                    <li>Download Shortcodes in Post/Pages</li>
                    <li>Multiple File Upload</li>
                    <li>Automatic Zip Compression</li>
                    <li>X</li>
                    <li>Restricted Customer Zone</li>
                    <li>Send and receive files from admin</li>
                       <li class="price">$49.00</li>
                    <li class="action"><a href="https://www.cminds.com/wordpress-plugins-library/downloadsmanager/" style="background-color:darkblue;" target="_blank">More Info</a> &nbsp;&nbsp;<a href="https://www.cminds.com/?edd_action=add_to_cart&download_id=51133&wp_referrer=https://www.cminds.com/checkout/&edd_options[price_id]=1" target="_blank">Buy Now</a></li>
              </ul>
              <ul>
                    <li class="heading">Pro + MicroPayments</li>
                    <li class="price">$59.00</li>
                    <li class="action"><a href="https://www.cminds.com/wordpress-plugins-library/downloadsmanager/" style="background-color:darkblue;" target="_blank">More Info</a> &nbsp;&nbsp;<a href="https://www.cminds.com/?edd_action=add_to_cart&download_id=11737&wp_referrer=https://www.cminds.com/checkout/&edd_options[price_id]=0" target="_blank">Buy Now</a></li>
                   <li>Unlimited Downloads</li>
                    <li>Download Categories</li>
                    <li>Voting per each download</li>
                    <li>View count per each download</li>
                    <li>Support forum per each download</li>
                    <li>Internal Search</li>
                    <li>User Notifications</li>
                     <li>All users can download</li>
                   <li>User Groups Permissions</li>
                    <li>Social Media Integration</li>
                    <li>Downloads can be Password Protected</li>
                    <li>Admin can define Upload Restriction</li>
                    <li>Admin can define View Restrictions</li>
                    <li>Shortcodes for downloads list</li>
                    <li>Integration with Store plugins using shortcodes</li>
                    <li>Multisite Support</li>
                    <li>Moderation Support</li>
                    <li>Gravatar Support</li>
                    <li>Widgets</li>
                    <li>Disclaimer Support</li>
                    <li>File Preview Option</li>
                    <li>Audio & Video Player Option</li>
                    <li>Customize Download Page</li>
                    <li>Customize Plugin Permalink</li>
                    <li>User Profile with all Downloads</li>
                    <li>Extended internal Search</li>
                    <li>Tiles, list & category view of downloads index</li>
                    <li>Social share widget</li>
                    <li>Log & Statistics</li>
                    <li>Second Level Navigation</li>
                    <li>Download Shortcodes in Post/Pages</li>
                    <li>Multiple File Upload</li>
                    <li>Automatic Zip Compression</li>
                    <li>Integration with Micropayments</li>
                    <li>X</li>
                    <li>X</li>
                     <li class="price">$59.00</li>
                   <li class="action"><a href="https://www.cminds.com/wordpress-plugins-library/downloadsmanager/" style="background-color:darkblue;" target="_blank">More Info</a> &nbsp;&nbsp;<a href="https://www.cminds.com/?edd_action=add_to_cart&download_id=11737&wp_referrer=https://www.cminds.com/checkout/&edd_options[price_id]=0" target="_blank">Buy Now</a></li>
                 </ul>
            

            </div>',
);

