<?php
/**
 * @file
 * Theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: Node body or teaser depending on $teaser flag.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $display_submitted: whether submission information should be displayed.
 * - $links: Themed links like "Read more", "Add new comment", etc. output
 *   from theme_links().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 *   The following applies only to viewers who are registered users:
 *   - node-by-viewer: Node is authored by the user currently viewing the page.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $build_mode: Build mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $build_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * The following variables are deprecated and will be removed in Drupal 7:
 * - $picture: This variable has been renamed $user_picture in Drupal 7.
 * - $submitted: Themed submission information output from
 *   theme_node_submitted().
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see zen_preprocess()
 * @see zen_preprocess_node()
 * @see zen_process()
 */

?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix">
  <?php print $user_picture; ?>

  <?php if (!$page): ?>
    <h2 class="title"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>

  <?php if ($unpublished): ?>
    <div class="unpublished"><?php print t('Unpublished'); ?></div>
  <?php endif; ?>

  <div class="content">

<div class="field field-type-filefield field-field-profile-picture">
  <div class="field-items">
      <div class="field-item odd"><?php print $node->field_profile_picture[0]['view'] ?></div>
  </div>
</div>


<?php if(!empty($node->field_salutation[0]['view'])): ?>
<div class="field field-type-number-integer field-field-salutation">
  <div class="field-label"> <?php print t('Salutation'); ?> </div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_salutation[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty( $node->field_firstname[0]['view'])): ?>
<div class="field field-type-text field-field-firstname">
  <div class="field-label"> <?php print t('Firstname'); ?> </div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_firstname[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_midname[0]['view'])): ?> 
<div class="field field-type-text field-field-midname">
  <div class="field-label"><?php print t('Midname'); ?></div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_midname[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_lastname[0]['view'])): ?> 
<div class="field field-type-text field-field-lastname">
  <div class="field-label"><?php print t('Last name'); ?></div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_lastname[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_biography[0]['view'])): ?>
<div class="field field-type-text field-field-biography">
  <div class="field-label"><?php print t('Biography'); ?></div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_biography[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_sex[0]['view'])): ?> 
<div class="field field-type-number-integer field-field-sex">
  <div class="field-label"><?php print t('Sex'); ?></div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_sex[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_spoken_languages[0]['view'])): ?>
<div class="field field-type-iso-639-code field-field-spoken-languages">
  <div class="field-label"><?php print t('Spoken Languages'); ?></div>
  <div class="field-items">
    <?php foreach ((array)$node->field_spoken_languages as $item) { ?>
      <div class="field-item"><?php print $item['view'] ?></div>
    <?php } ?>
  </div>
</div>
<?php endif; ?>



<?php if(!empty($node->field_year_birth[0]['view'])): ?>
<div class="field field-type-text field-field-year-birth">
  <div class="field-label"><?php print t('Year Birth'); ?></div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_year_birth[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_telephone[0]['view'])): ?> 
<div class="field field-type-text field-field-telephone">
  <div class="field-label"><?php print t('Telephone'); ?></div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_telephone[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_fax[0]['view'])): ?>
<div class="field field-type-text field-field-fax">
  <div class="field-label">Fax</div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_fax[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_alternative_mail[0]['view'])): ?>
<div class="field field-type-email field-field-alternative-mail">
  <div class="field-label"><?php print t('Alternative Mail'); ?></div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_alternative_mail[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_website[0]['view'])): ?>
<div class="field field-type-link field-field-website">
  <div class="field-label"><?php print t('Website'); ?></div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_website[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_facebook_id[0]['view'])): ?>
<div class="field field-type-text field-field-facebook-id">
  <div class="field-label"><?php print t('Facebook ID'); ?></div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_facebook_id[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_linkedin_id[0]['view'])): ?>
<div class="field field-type-text field-field-linkedin-id">
  <div class="field-label">LinkedIn ID</div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_linkedin_id[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty( $node->field_ning_id[0]['view'])): ?>
<div class="field field-type-text field-field-ning-id">
  <div class="field-label">Ning ID</div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_ning_id[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty( $node->field_skype_id[0]['view'])): ?>
<div class="field field-type-text field-field-skype-id">
  <div class="field-label">Skype ID</div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_skype_id[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty( $node->field_twitter_id[0]['view'])): ?>
<div class="field field-type-text field-field-twitter-id">
  <div class="field-label">Twitter ID</div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_twitter_id[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty( $node->field_myspace_id[0]['view'])): ?>
<div class="field field-type-text field-field-myspace-id">
  <div class="field-label">MySpace ID</div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_myspace_id[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_delicious_id[0]['view'])): ?>
<div class="field field-type-text field-field-delicious-id">
  <div class="field-label">Delicious ID</div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_delicious_id[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_principal_work[0]['view'])): ?>
<div class="field field-type-text field-field-principal-work">
  <div class="field-label"><?php print t('Principal Work'); ?></div>
  <div class="field-items">
    <?php foreach ((array)$node->field_principal_work as $item) { ?>
      <div class="field-item"><?php print $item['view'] ?></div>
    <?php } ?>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_specializations[0]['view'])): ?>
<div class="field field-type-content-taxonomy field-field-specializations">
  <div class="field-label"><?php print t('Specializations'); ?></div>
  <div class="field-items">
    <?php foreach ((array)$node->field_specializations as $item) { ?>
      <div class="field-item"><?php print $item['view'] ?></div>
    <?php } ?>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_themes_of_interest[0]['view'])): ?>
<div class="field field-type-content-taxonomy field-field-themes-of-interest">
  <div class="field-label"><?php print t('Themes of Interest'); ?></div>
  <div class="field-items">
    <?php foreach ((array)$node->field_themes_of_interest as $item) { ?>
      <div class="field-item"><?php print $item['view'] ?></div>
    <?php } ?>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_cv_file[0]['view'])): ?>
<div class="field field-type-filefield field-field-cv-file">
  <div class="field-label">CV</div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_cv_file[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_mountain_ranges_work[0]['view'])): ?>
<div class="field field-type-content-taxonomy field-field-mountain-ranges-work">
  <div class="field-label"><?php print t('Mountain Ranges Work'); ?></div>
  <div class="field-items">
    <?php foreach ((array)$node->field_mountain_ranges_work as $item) { ?>
      <div class="field-item"><?php print $item['view'] ?></div>
    <?php } ?>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_affiliation)): ?>
<div class="field field-type-text field-field-affiliation">
  <div class="field-label"><?php print t('Affiliation'); ?></div>
  <div class="field-items">
    <?php foreach ((array)$node->field_affiliation as $item) { ?>
      <div class="field-item"><?php print $item['view'] ?></div>
    <?php } ?>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_mountain_ranges_interest[0]['view'])): ?>
<div class="field field-type-content-taxonomy field-field-mountain-ranges-interest">
  <div class="field-label"><?php print t('Mountain Ranges Interest'); ?></div>
  <div class="field-items">
    <?php foreach ((array)$node->field_mountain_ranges_interest as $item) { ?>
      <div class="field-item"><?php print $item['view'] ?></div>
    <?php } ?>
  </div>
</div>
<?php endif; ?>


<?php if(!empty($node->field_profile_regions)): ?>
<div class="field field-type-content-taxonomy field-field-profile-regions">
  <div class="field-label"><?php print t('Regions of work'); ?></div>
  <div class="field-items">
    <?php foreach ((array)$node->field_profile_regions as $item) { ?>
      <div class="field-item"><?php print $item['view'] ?></div>
    <?php } ?>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_organization_name[0]['view'])): ?>
<div class="field field-type-nodereference field-field-organization-name">
  <div class="field-label"><?php print t('Organization Name'); ?></div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_organization_name[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_job_position[0]['view'])): ?>
<div class="field field-type-text field-field-job-position">
  <div class="field-label"><?php print t('Job position'); ?></div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_job_position[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_like_to_volunteer[0]['view'])): ?>
<div class="field field-type-text field-field-like-to-volunteer">
  <div class="field-label"><?php print t('How would you like to volunteer your services to the MKH ?'); ?></div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_like_to_volunteer[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>



<?php if(!empty($node->field_past_organization[0]['view'])): ?>
<div class="field field-type-text field-field-past-organization">
  <div class="field-label"><?php print t('Organization'); ?></div>
  <div class="field-items">
    <?php foreach ((array)$node->field_past_organization as $item) { ?>
      <div class="field-item"><?php print $item['view'] ?></div>
    <?php } ?>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_other_networks[0]['view'])): ?>
<div class="field field-type-text field-field-other-networks">
  <div class="field-label"><?php print t('Others Networks'); ?></div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_other_networks[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_past_affiliation_year[0]['view'])): ?>
<div class="field field-type-text field-field-past-affiliation-year">
  <div class="field-label"><?php print t('Year'); ?></div>
  <div class="field-items">
    <?php foreach ((array)$node->field_past_affiliation_year as $item) { ?>
      <div class="field-item"><?php print $item['view'] ?></div>
    <?php } ?>
  </div>
</div>
<?php endif; ?>

<?php 

if(!empty($node->field_background_university[0]['view'])): ?>

<div class="field field-type-text field-field-background-university">
  <div class="field-label"><?php print t('University'); ?></div>
  <div class="field-items">
    <?php foreach ((array)$node->field_background_university as $item) { ?>
      <div class="field-item"><?php print $item['view'] ?></div>
    <?php } ?>
  </div>
</div>


<?php endif; ?>

<?php if(!empty($node->field_background_year[0]['view'])): ?>
<div class="field field-type-text field-field-background-year">
  <div class="field-label">Títulos académicos - Año</div>
  <div class="field-items">
    <?php foreach ((array)$node->field_background_year as $item) { ?>
      <div class="field-item"><?php print $item['view'] ?></div>
    <?php } ?>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_background_attended[0]['view'])): ?>
<div class="field field-type-text field-field-background-attended">
  <div class="field-label">Títulos académicos - Asistió</div>
  <div class="field-items">
    <?php foreach ((array)$node->field_background_attended as $item) { ?>
      <div class="field-item"><?php print $item['view'] ?></div>
    <?php } ?>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_background_course[0]['view'])): ?>
<div class="field field-type-text field-field-background-course">
  <div class="field-label">Títulos académicos - Curso</div>
  <div class="field-items">
    <?php foreach ((array)$node->field_background_course as $item) { ?>
      <div class="field-item"><?php print $item['view'] ?></div>
    <?php } ?>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_background_degree[0]['view'])): ?>
<div class="field field-type-text field-field-background-degree">
  <div class="field-label">Títulos académicos - Grado</div>
  <div class="field-items">
    <?php foreach ((array)$node->field_background_degree as $item) { ?>
      <div class="field-item"><?php print $item['view'] ?></div>
    <?php } ?>
  </div>
</div>
<?php endif; ?>


<?php if(!empty($node->field_work_employer[0]['view'])): ?>
<div class="field field-type-text field-field-work-employer">
  <div class="field-label">Employer</div>
  <div class="field-items">
    <?php foreach ((array)$node->field_work_employer as $item) { ?>
      <div class="field-item"><?php print $item['view'] ?></div>
    <?php } ?>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_work_position[0]['view'])): ?>
<div class="field field-type-text field-field-work-position">
  <div class="field-label"><?php print t('Position'); ?></div>
  <div class="field-items">
    <?php foreach ((array)$node->field_work_position as $item) { ?>
      <div class="field-item"><?php print $item['view'] ?></div>
    <?php } ?>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_work_description[0]['view'])): ?>
<div class="field field-type-text field-field-work-description">
  <div class="field-label"><?php print t('Description'); ?></div>
  <div class="field-items">
    <?php foreach ((array)$node->field_work_description as $item) { ?>
      <div class="field-item"><?php print $item['view'] ?></div>
    <?php } ?>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_work_towncity[0]['view'])): ?>
<div class="field field-type-text field-field-work-towncity">
  <div class="field-label"><?php print t('Town/City'); ?></div>
  <div class="field-items">
    <?php foreach ((array)$node->field_work_towncity as $item) { ?>
      <div class="field-item"><?php print $item['view'] ?></div>
    <?php } ?>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_work_time_period[0]['view'])): ?>
<div class="field field-type-text field-field-work-time-period">
  <div class="field-label">Trabajo - Periodo de tiempo</div>
  <div class="field-items">
    <?php foreach ((array)$node->field_work_time_period as $item) { ?>
      <div class="field-item"><?php print $item['view'] ?></div>
    <?php } ?>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_profile_location[0]['view'])): ?>
<div class="field field-type-openlayers-wkt field-field-profile-location">
  <div class="field-label"><?php print t('Location'); ?></div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_profile_location[0]['view'] ?></div>
  </div>
</div>

<div id="ubicacion">

<?php if(!empty($node->field_profile_location[0]['view'])): ?>
<div class="field field-type-text field-field-profile-street">
  <div class="field-label">Street</div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_profile_street[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_profile_city[0]['view'] )): ?>
<div class="field field-type-text field-field-profile-city">
  <div class="field-label"><?php print t('City'); ?></div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_profile_city[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_profile_state[0]['view'] )): ?>
<div class="field field-type-text field-field-profile-state">
  <div class="field-label"><?php print t('State/Province'); ?></div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_profile_state[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>


<?php if(!empty($node->field_profile_postal_code[0]['view'] )): ?>
<div class="field field-type-text field-field-profile-postal-code">
  <div class="field-label"><?php print t('Postal code'); ?></div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_profile_postal_code[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_profile_country[0]['view'] )): ?>
<div class="field field-type-text field-field-profile-country">
  <div class="field-label"><?php print t('Country'); ?></div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_profile_country[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

<?php if(!empty($node->field_profile_location_name[0]['view'])): ?>
<div class="field field-type-text field-field-profile-location-name">
  <div class="field-label"><?php print t('Location name'); ?></div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_profile_location_name[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

</div>

<?php endif; ?>



<?php if(!empty($node->field_profile_old_address[0]['view'] )): ?>
<div class="field field-type-text field-field-profile-old-address">
  <div class="field-label"><?php print t('Old address'); ?></div>
  <div class="field-items">
      <div class="field-item"><?php print $node->field_profile_old_address[0]['view'] ?></div>
  </div>
</div>
<?php endif; ?>

  </div>
  
  <?php if ($display_submitted || $terms): ?>
    <div class="meta">
      <?php if ($display_submitted): ?>
        <span class="submitted">
          <?php
            print t('Submitted by !username on !datetime',
              array('!username' => $name, '!datetime' => $date));
          ?>
        </span>
      <?php endif; ?>

      <?php if ($terms): ?>
        <div class="terms terms-inline"><?php print $terms; ?></div>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <?php print $links; ?>
</div> <!-- /.node -->
