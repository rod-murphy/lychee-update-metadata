<?php

if (!defined('LYCHEE')) exit('Error: Direct access is not allowed!');

class UpdateMetadataPlugin implements SplObserver {

    private $database = null;
    private $settings = null;

    public function __construct($database, $settings) {

        # These params are passed to your plugin from Lychee
        # Save them to access the database and settings of Lychee
        $this->database = $database;
        $this->settings = $settings;

        # Add more code here if wanted
        # __construct() will be called every time Lychee gets called
        # Make sure this part is performant

        return true;

    }

    public function update(\SplSubject $subject) {

        # Check if the called hook is the hook you are waiting for
        # A list of all hooks is available online
        if ($subject->action == 'Photo::setTags:after' || $subject->action == 'Photo::setTags:before') {
          error_log("Setting tags: {$subject->action}: ". print_r($subject->args, true));
          return true;
        }

        # Do something when Photo::add:before gets called
        # $this->database => The database of Lychee
        # $this->settings => The settings of Lychee
        # $subject->args => Params passed to the original function

        return true;

    }

}

# Register your plugin
$plugins->attach(new UpdateMetadataPlugin($database, $settings));
