<?php 
/**
 * Plugin Name: Resume Maker Data Saver
 * Description: Save Data of the CVs into the database
 */


 add_action('resume_maker_init', 'save_cv_data');

function save_cv_data($data)
{
    $new_developer = array(
    'post_title'    => $data['name'],
    'post_content'    => $data['summary'],
    'post_status'   => 'draft', 
    'post_author'   => get_current_user_id(), 
    'post_type'     => 'developer', 
    'meta_input'    => array(
      '_developer_job'    => $data['job'],
      '_developer_email'    => $data['email'],
      '_developer_phone'    => $data['phone'],
      '_developer_state'    => $data['state'],
      '_developer_city'    => $data['city'],
      '_developer_portfolio'    => $data['portfolio'],
      '_developer_languages'    => $data['languages'],
      '_developer_tools'    => $data['tools'],
      '_developer_workedin'    => json_encode($data['workedin']),
      '_developer_education'    => json_encode($data['education']),
      '_developer_yearsexp'    => $data['yearsexp'],
    ),
    );

    $new_developer_id = wp_insert_post($new_developer);

    foreach (explode(',',$data['languages']) as $language) {
        wp_set_post_terms($new_developer_id, $language, 'languages', true);
    }

    foreach (explode(',',$data['tools']) as $tool) {
        wp_set_post_terms($new_developer_id, $tool, 'tools', true);
    }
  
  
}