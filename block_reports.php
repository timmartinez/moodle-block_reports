<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**
 * Reports Block
 *
 * @package   block_reports
 * @copyright Tim Martinez <martinez.tim@me.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

class block_reports extends block_base {

    /**
     * Initialises the block.
     *
     * @return void
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_reports');
    }
    
    /**
     * Gets the block contents.
     *
     * @return string The block HTML.
     */
    public function get_content() {
        global $OUTPUT, $COURSE;

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->footer = '';

        //Build a list of reports to render.
        $params = array('id' => $COURSE->id);
        $data = array('entries' =>
            array(
                array('name' => get_string('pluginname', 'report_log'), 'url' => new \moodle_url('/report/log/index.php', $params)),
                array('name' => get_string('pluginname', 'report_outline'), 'url' => new \moodle_url('/report/outline/index.php', $params)),
                array('name' => get_string('pluginname', 'report_participation'), 'url' => new \moodle_url('/report/participation/index.php', $params)),
                array('name' => get_string('pluginname', 'report_progress'), 'url' => new \moodle_url('/report/progress/index.php', array('course' => $COURSE->id)))
            )
        );

        $this->content->text = $OUTPUT->render_from_template('block_reports/content', $data);

        return $this->content;
    }
    
    /**
     * Defines in which pages this block can be added.
     *
     * @return array of the pages where the block can be added.
     */
    public function applicable_formats() {
        return [
            'admin' => false,
            'site-index' => false,
            'course-view' => true,
            'mod' => false,
            'my' => false,
        ];
    }
}
