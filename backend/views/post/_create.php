<div class="containier-fluid">
    <div class="row">
        <div class="col-md-4">
            <?= $this->render('_panel', [
                'forms' => $forms
            ]) ?>
        </div>
        <div class="col-md-8">
            <?php if ($form_fields != null): ?>
                <?= $this->render('_form', [
                    'model' => $model,
                    'category' => $category,
                    'forms' => $forms,
                    'status' => $status,
                    'visibility_type' => $visibility_type,
                    'publish_type' => $publish_type,
                    'page' => $page,
                    'form_fields' => $form_fields,
                    'form_title' => $form_title
                ]) ?>
            <?php endif; ?>
        </div>
    </div>
</div>