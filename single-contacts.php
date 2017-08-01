<?php if ((isset($_POST['dt_contacts_noonce']) && wp_verify_nonce( $_POST['dt_contacts_noonce'], 'update_dt_contacts' ))) { dt_save_contact($_POST); } // Catch and save update info ?>
<?php if ( ! empty($_POST['response'] )) { dt_update_overall_status($_POST); } ?>
<?php if ( ! empty($_POST['comment_content'] )) { dt_update_required_update($_POST); } ?>
<?php $contact = Disciple_Tools_Contacts::get_contact( get_the_ID(), true ); ?>
<?php $contact_fields = Disciple_Tools_Contacts::get_contact_fields(); ?>
<?php get_header(); ?>
<?php //var_dump($contact_fields['milestone_sharing'])?>
<?php //var_dump($contact->fields["milestone_sharing"])?>

<div id="errors"> </div>

    <div id="content">

        <div id="inner-content">

            <!-- Breadcrumb Navigation-->
            <nav aria-label="You are here:" role="navigation" class="hide-for-small-only">
                <ul class="breadcrumbs">

                    <li><a href="<?php echo home_url('/'); ?>">Dashboard</a></li>
                    <li><a href="<?php echo home_url('/'); ?>contacts/">Contacts</a></li>
                    <li>
                        <span class="show-for-sr">Current: </span> <?php the_title(); ?>
                    </li>
                </ul>
            </nav>


            <main id="main" class="large-8 medium-8 columns" role="main">
                <section class="bordered-box medium-12 columns">
                    Status: <?php echo $contact->fields["overall_status"]["label"] ?>
                </section>

                <section id="contact-details" class="bordered-box medium-12 columns">
                    <?php get_template_part( 'parts/loop', 'single-contact' ); ?>
                </section>

                <section id="faith" class="bordered-box medium-6 columns">
                    <label class="section-header">Progress</label>
                    <strong>Seeker Path</strong>
<!--                    @todo calculate % based on actions-->
                    <div class="progress" role="progressbar" tabindex="0" aria-valuenow="20"
                         aria-valuemin="0" aria-valuetext="25 percent" aria-valuemax="100">
                        <span class="progress-meter" style="width: <?php echo ($contact->fields["seeker_path"]["key"] ?? 0) * 20?>%">
                        <p class="progress-meter-text"><?php echo $contact->fields["seeker_path"]["label"] ?? ""?></p>
                        </span>
                    </div>
                    <strong>Faith Milestones</strong>
                  <div class="small button-group">

                    <?php forEach($contact->fields as $field => $val){
                        if (strpos($field, "milestone_") === 0){
                          $class = $val['key'] === '0' ?  "empty-select-button" : "selected-select-button";
                          $html = '<button onclick="save('. get_the_ID() .', \'' .  $field . '\', ' . ($val['key'] === '1' ? '0' : '1') . ')"';
                          $html .= 'id="'.$field .'"';
                          $html .= 'class="' . $class . ' select-button button ">' . $contact_fields[$field]["name"] . '</a>';
                          echo  $html;

                        }
                    }
                    ?>
                  </div>
                </section>

                <section id="relationships" class="bordered-box medium-6 columns">
                    <?php
                    global $wp_query, $post_id;

                    // Find connected pages (for all posts)
                    p2p_type( 'contacts_to_contacts' )->each_connected( $wp_query, array(), 'disciple' );
                    p2p_type( 'contacts_to_groups' )->each_connected( $wp_query, array(), 'groups' );
                    ?>

                    <section class="bordered-box">

                        <form method="get" action="<?php echo get_permalink(); ?>">
                            <span class="float-right">
                                <input type="hidden" name="action" value="edit"/>
                                <input type="submit" value="Add" class="button" />
                            </span>
                        </form>

                        <h3>Relationships</h3>

                        <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                            <?php foreach ( $post->disciple as $post ) : setup_postdata( $post ); ?>

                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

                            <?php endforeach; ?>

                            <?php  wp_reset_postdata(); // set $post back to original post ?>

                        <?php endwhile; ?>

                    </section>

                    <section class="bordered-box">

                        <form method="get" action="<?php echo get_permalink(); ?>">
                        <span class="float-right">
                            <input type="hidden" name="action" value="edit"/>
                            <input type="submit" value="Add" class="button" />
                        </span>
                        </form>

                        <h3>Groups</h3>

                        <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                            <?php foreach ( $post->groups as $post ) : setup_postdata( $post ); ?>

                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </li>

                            <?php endforeach; ?>

                            <?php  wp_reset_postdata(); // set $post back to original post ?>

                        <?php endwhile; ?>


                    </section>


                </section>

            </main> <!-- end #main -->

            <aside class="medium-4 columns">
                <?php get_template_part( 'parts/loop', 'activity-comment' ); ?>
            </aside>

        </div> <!-- end #inner-content -->

    </div> <!-- end #content -->

<?php get_footer(); ?>
