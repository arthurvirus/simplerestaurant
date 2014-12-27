<?php
 
/**
 * @file
 * Contains \Drupal\demo\Form\DemoForm.
 */
 
namespace Drupal\simplerestaurant\Form;
 
use Drupal\Core\Form\FormBase ;
use Drupal\Core\Form\FormStateInterface;
use Drupal\taxonomy\Entity\Vocabulary;
 
class AddFoodItemForm extends FormBase {
   
  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'AddFoodItem_form';
  }
   
  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

  //First get all the taxonomy term
 
  $entity_type = 'taxonomy_term';
  $properties = array('vid' => 'sellable_category');
  $vocabulary = entity_load_multiple_by_properties($entity_type,$properties);// \Drupal\taxonomy\Entity\Vocabulary() ;
//$vocabulary = entity_load_multiple($entity_type, NULL, FALSE);

//dsm($vocabulary);

  foreach($vocabulary as $term){
    //$food_item_list[$products->nid] = $term->title;
    dsm($term->name->value);
	dsm($term->weight->value);
	dsm($term->tid->value);
	dsm($term);//Parent ?
	
	///dsm($term);
  }
  
  
  $form['email'] = array(
      '#type' => 'email',
      '#title' => $this->t('Your .com email address.')
    );
	 $form['ola'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('dmail address.')
    );
    $form['show'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    );
     
    return $form;
  }
   
  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
     
    if (strpos($form_state['values']['email'], '.com') === FALSE ) {
      $this->setFormError('email', $form_state, $this->t('This is not a .com email address.'));
    } 
  }
  
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
     
    drupal_set_message($this->t('Your email address is @email', array('@email' => $form_state['values']['email'])));
  }
   
}