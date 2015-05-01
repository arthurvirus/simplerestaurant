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
  $categories = array();
  $entity_type = 'taxonomy_term';
  $properties = array('vid' => 'sellable_category');
  $vocabulary = entity_load_multiple_by_properties($entity_type,$properties);

  foreach($vocabulary as $term){
  /*
    dsm($term->name->value);
	dsm($term->weight->value);
	dsm($term->tid->value);
	*/
	$tid = $term->tid->value;
	$children = \Drupal::entityManager()->getStorage('taxonomy_term')->loadChildren($tid);
	if( count($children) == 0 ){
		//add only the leaves in the dropdownbox
		array_push($categories, $term->name->value);
	}
  }
  
  //dsm(count($categories));
	$form['category'] = array(
   '#type' => 'select',
   '#title' => t('Category'),
   '#options' => $categories,
   //'#default_value' => $category['selected'],
   //'#description' => t('bonjour melissa'),
 );
  
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
     //TODO Find the category Id based on the name
	 
    if (strpos($form_state['values']['email'], '.com') === FALSE ) {
      $this->setFormError('email', $form_state, $this->t('This is not a .com email address.'));
    } 
  }
  
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
     
	 //TODO create content based on form
    drupal_set_message($this->t('Your email address is @email', array('@email' => $form_state['values']['email'])));
  }
   
}