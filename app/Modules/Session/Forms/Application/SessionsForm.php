<?php namespace App\Modules\Session\Forms\Application;

use App\Base\Forms\AdminForm;

class SessionsForm extends AdminForm
{
    public function buildForm()
    {
        $this
            ->add('id', 'hidden', [
                'attr' => ['id' => 'id']
            ])
            ->add('space_id', 'choice', [
                'choices' => $this->getSpaces(),
                'selected' => $this->space_id,
                'attr' => ['id' => 'space_select'],
                'label' => trans('Reservation::application.fields.session.where') . ' | <a class="agreement" href="#" data-toggle="popover" title=" قواعد و شروط و توجيهات الاستغلال" data-content="">قواعد إستخدام المساحة<i class="fa fa-info-circle" aria-hidden="true"></i></a><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw" style="font-size:12px; display:none;"></i>'
            ])
            ->add('name', 'text', [
                'label' => trans('Reservation::application.fields.session.name'),
                'attr' => ['id' => 'name'],
                'value' => function ($name) {
                    return $name;
                }
            ])
            ->add('start_date', 'text', [
                'label' => trans('Reservation::application.fields.session.start_time_date'),
                'attr' => ['id' => 'start_date'],
                'value' => function ($name) {
                    return $name;
                }
            ])
            ->add('start_time', 'text', [
                'label' => trans('Reservation::application.fields.session.start_time_time'),
                'attr' => ['id' => 'start_time'],
                'value' => function ($start_time) {
                    return $start_time;
                }
            ])
            ->add('fees', 'number', [
                'attr' => ['id' => 'fees'],
                'label' => trans('Reservation::application.fields.session.fees') . '<span class="fees"></span>'
            ]);
            $this->OptionAndPeriod('period', trans('Reservation::dashboard.fields.session.period'), false, true, true, false, false);
            $this->add('description', 'textarea', [
                'label' => trans('Reservation::application.fields.session.description'),
                'attr' => ['id' => 'excerpt']
            ]);
    }
    protected function getSpaces(){
        $array = array();
        foreach ($this->data[0]->spaces()->where('status', 'working')->get()->toArray() as $space)
        {    
            $array = array_add($array, $space['id'], $space['name']);   
        }
        return $array;
    }
}
