<?php

/**
 * @file
 * Contains \Drupal\Tests\comment\Kernel\Migrate\d6\MigrateCommentVariableEntityFormDisplayTest.
 */

namespace Drupal\Tests\comment\Kernel\Migrate\d6;

use Drupal\Core\Entity\Entity\EntityFormDisplay;
use Drupal\Tests\comment\Kernel\Migrate\d6\MigrateCommentVariableDisplayBase;

/**
 * Upgrade comment variables to core.entity_form_display.node.*.default.yml.
 *
 * @group migrate_drupal_6
 */
class MigrateCommentVariableEntityFormDisplayTest extends MigrateCommentVariableDisplayBase {

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->executeMigration('d6_comment_entity_form_display');
  }

  /**
   * Tests comment variables migrated into an entity display.
   */
  public function testCommentEntityFormDisplay() {
    foreach (['page', 'article', 'story'] as $type) {
      $component = EntityFormDisplay::load('node.' . $type . '.default')
        ->getComponent('comment');
      $this->assertIdentical('comment_default', $component['type']);
      $this->assertIdentical(20, $component['weight']);
    }
  }

}
