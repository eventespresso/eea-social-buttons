<h3 class="ee-registration-social_buttons-h3"><?php echo __('Support us on Social Media -- Spread the Word', 'event_espresso'); ?></h3>

		<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $event_permalink; ?>" data-text="<?php echo sprintf(__('I just registered for %1s at %2s', 'event_espresso'), $event_name, $organization_name); ?>"  data-via="<?php echo $co_twitter; ?>" data-size="large"><?php echo __('Tweet', 'event_espresso'); ?></a>

		<div id="fb-root"></div>


		<div class="fb-like" data-href="<?php echo $event_permalink; ?>" data-send="true" data-width="450" data-show-faces="true"></div>
