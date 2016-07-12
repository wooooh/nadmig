<?php namespace App\Modules\Attendees\Forms\Application;

use App\Base\Forms\AdminForm;

class AttendeesForm extends AdminForm
{
    public function buildForm()
    {
        $this
		    ->add('name', 'text', [
		            'label' => trans('Attendees::application.fields.attendees.name'),
                    'required' => true
		        ])
            ->add('birthday', 'text', [
                    'label' => trans('Attendees::application.fields.attendees.birthday'),
                    'required' => true
                ])
            ->add('type', 'choice', [
                    'choices' => ['m' => 'ذكر', 'f' => 'آنثى'],
                    'selected' => $this->type,
                    'label' => trans('Attendees::application.fields.attendees.type'), 
                    'required' => true
                ])
            ->add('address', 'text', [
                    'label' => trans('Attendees::application.fields.attendees.address'), 
                    'required' => true
                ])
            ->add('city', 'choice', [
                    'choices' => $this->getGovernorates(),
                    'selected' => $this->city,
                    'label' => trans('Attendees::application.fields.attendees.city'),
                    'required' => true
                ])
            ->add('phone_number', 'number', [
                    'label' => trans('Attendees::application.fields.attendees.phone_number'), 
                    
                ])
            ->add('email', 'text', [
                    'label' => trans('Attendees::application.fields.attendees.email'),
                    
                ])
            ->add('school_name', 'text', [
                    'label' => trans('Attendees::application.fields.attendees.school_name'),
                    'required' => true
                ])
            ->add('track', 'choice', [
                    'choices' => ['music&sound' => 'الصوت والموسيقي', 'video' => 'الفيديو', 'visual_art' => 'التعبير البصري ( الرسم بآنواعه )'],
                    'selected' => $this->track,
                    'label' => trans('Attendees::application.fields.attendees.track'),
                    'required' => true
                ])
            ->add('hear_about_us[type]', 'choice', [
                    'choices' => ['facebook' => 'فيس يوك', 'twitter' => 'تويتر', 'partner_ngo' => 'جمعيه شريكه', 'friend' => 'صديق', 'other' => 'آخري'],
                    'selected' => $this->hear_about_us,
                    'attr' => ['id' => 'hear_about_us'],
                    'label' => trans('Attendees::application.fields.attendees.hear_about_us'),
                    'required' => true
                ])
            ->add('hear_about_us[other]', 'hidden', [
                    'attr' => ['id' => 'hear_about_us_other'],
                    'label' => trans('Attendees::application.fields.attendees.other')
                ])
            ->add('media_coverage', 'choice', [
                    'choices' => [1 => 'نعم', 0 => 'لا'],
                    'selected' => $this->media_coverage,
                    'label' => trans('Attendees::application.fields.attendees.media_coverage'), 
                    'required' => true
                ])
            ->add('guardian_name', 'text', [
                    'label' => trans('Attendees::application.fields.attendees.guardian_name'), 
                    'required' => true
                ])
            ->add('guardian_phone', 'text', [
                    'label' => trans('Attendees::application.fields.attendees.guardian_phone'), 
                    'required' => true
                ])
            ->add('guardian_approval', 'textarea', [
                    'label' => trans('Attendees::application.fields.attendees.guardian_approval'), 
                    'required' => true
                ]);
        parent::buildForm();
    }
}