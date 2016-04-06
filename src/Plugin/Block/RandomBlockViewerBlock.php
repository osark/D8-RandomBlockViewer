<?php

/**
 * @file
 * Contains \Drupal\random_block_viewer\Plugin\Block\RandomBlockViewerBlock.
 */

namespace Drupal\random_block_viewer\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'RandomBlockViewerBlock' block.
 *
 * @Block(
 *  id = "random_block_viewer_block",
 *  admin_label = @Translation("Random block viewer block"),
 * )
 */
class RandomBlockViewerBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['block_pool'] = array(
      '#type' => 'entity_autocomplete',
      '#title' => $this->t('Block Pool'),
      '#target_type' => 'block',
      '#description' => $this->t('List of blocks as a pool to view one of them randomly.'),
      '#weight' => '0',
    );
    if (isset($this->configuration['block_pool'])) {
      $form['block_pool']['#default_value'] = $this->configuration['block_pool'];
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['block_pool'] = $form_state->getValue('block_pool');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['random_block_viewer_block_block_pool']['#markup'] = '<p>' . $this->configuration['block_pool'] . '</p>';

    return $build;
  }

}
