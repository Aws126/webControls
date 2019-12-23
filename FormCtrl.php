<?php 
declare(strict_types=1);
namespace Nette\Forms\Rendering;

require __DIR__.'/../vendor/autoload.php';
use Nette;
use Nette\Forms\Form;
use Tracy\Debugger;
use Tracy\Dumper;
//Debugger::enable();
 
class FormCtrl
{
    

function makeBootstrap2(Form $form): void
{
	$renderer = $form->getRenderer();
	$renderer->wrappers['controls']['container'] = null;
	$renderer->wrappers['pair']['container'] = 'div class=control-group';
	$renderer->wrappers['pair']['.error'] = 'error';
	$renderer->wrappers['control']['container'] = 'div class=controls';
	$renderer->wrappers['label']['container'] = 'div class=control-label';
	$renderer->wrappers['control']['description'] = 'span class=help-inline';
	$renderer->wrappers['control']['errorcontainer'] = 'span class=help-inline';
	$form->getElementPrototype()->class('form-horizontal');

	foreach ($form->getControls() as $control) {
		$type = $control->getOption('type');
		if ($type === 'button') {
			$control->getControlPrototype()->addClass(empty($usedPrimary) ? 'btn btn-primary' : 'btn');
			$usedPrimary = true;

		} elseif (in_array($type, ['checkbox', 'radio'], true)) {
			$control->getSeparatorPrototype()->setName('div')->addClass($type);
		}
    }
}
    
    // -- properies
    private $name;
    private $id;
    // -- constructor
    public function __construct() {
        echo "myClass init'ed successfuly!!!";
    }
    // -- properties setters and getters
    public function setId($formID)
    {
        $this->id = $formID;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setName($formName)
    {
        $this->name = $formName;
    }
    public function getName()
    {
        return $this->name;
    }

    // -- Methods
    public function formGenerator() 
    {
        include ("config/GUI-Ar.php");
        echo "Hello Generator  (".$this->getId().")   -----";
        switch ($this->getId())
        {
            case "1":
                { 
                    echo "-- case 1 ----";
                    $form = new Form;
                    $form->addText('name', $F01_L01)
                         ->setRequired($F01_M01);
                    $form->addPassword('password', 'كلمة السر:')
	                     ->setRequired('من فضلك أدخل كلمة سر صحيحة')
	                     ->addRule($form::MIN_LENGTH, 'كلمة السر قصيرة، يجب أن تكون %d أحرف على الأقل', 6);
                    $form->addHidden('userid');
                    $form->addSubmit('submit', 'تسجيل الدخول');
                    $form->addGroup();
                   
                   // $form->setDefaults(['name' => 'اسم الموظف الأول + الرقم التعريفي','userid' => 1 ]);
                    // success
                    if ($form->isSuccess()) {
                        echo '<h2>Form was submitted and successfully validated</h2>';
                        Dumper::dump($form->getValues(), [Dumper::COLLAPSE => false]);
                        exit;
                    }
                    echo $form;
                    break;
                }
        }
    }
}

//include ("../index.php")
?>