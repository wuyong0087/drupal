<?php

/**
 * @file
 * Contains \Drupal\user\Tests\Update\UserUpdateEmailToken.
 */

namespace Drupal\user\Tests\Update;

use Drupal\system\Tests\Update\UpdatePathTestBase;

/**
 * Tests user email token upgrade path.
 *
 * @group Update
 */
class UserUpdateEmailToken extends UpdatePathTestBase {

  /**
   * {@inheritdoc}
   */
  protected function setDatabaseDumpFiles() {
    $this->databaseDumpFiles = [
      __DIR__ . '/../../../../system/tests/fixtures/update/drupal-8.bare.standard.php.gz',
      __DIR__ . '/../../../tests/fixtures/update/drupal-8.user-email-token-2587275.php',
    ];
  }

  /**
   * Tests that email token in status_blocked of user.mail is updated.
   */
  public function testEmailToken() {
    $mail = \Drupal::config('user.mail')->get('status_blocked');
    $this->assertTrue(strpos($mail['body'], '[site:account-name]'));
    $this->runUpdates();
    $mail = \Drupal::config('user.mail')->get('status_blocked');
    $this->assertFalse(strpos($mail['body'], '[site:account-name]'));
  }

}
