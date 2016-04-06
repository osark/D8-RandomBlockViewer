<?php

/**
 * @file
 * Contains \Drupal\random_block_viewer\Tests\BlockRenderTest
 */

namespace Drupal\random_block_viewer\Tests;

use Drupal\block\Tests\BlockTestBase;

/**
 * Tests random block viewer block.
 *
 * @group random_block_viewer
 */
class BlockRenderTest extends BlockTestBase {

  /**
   * Modules to install.
   *
   * @var array
   */
  public static $modules = array('block', 'filter', 'test_page_test', 'help', 'block_test', 'random_block_viewer');

  /**
   * Set to TRUE to strict check all configuration saved.
   *
   * @see \Drupal\Core\Config\Testing\ConfigSchemaChecker
   *
   * @var bool
   */
  protected $strictConfigSchema = false;

  /**
   * Test block exists
   */
  public function testBlockExists() {
    $block_name = 'random_block_viewer_block';
    // Create random title
    $title = $this->randomMachineName();
    $default_theme = $this->config('system.theme')->get('default');
    $edit = [
      'id' => strtolower($title),
      'region' => 'sidebar_first',
      'settings[label]' => $title,
    ];
    $this->drupalGet('admin/structure/block/add/' . $block_name . '/' . $default_theme);
    $this->drupalPostForm(NULL, $edit, t('Save block'));
    $this->assertText('The block configuration has been saved.', 'Block was saved');
    $this->assertNoText('This block is broken or missing.', 'Block exists');
  }
}
