        <input type="hidden" name="id" value="<?= $detail->id ?? '' ?>">
        <?= generateFormFields($form_fields_html, $detail ?? "") ?>