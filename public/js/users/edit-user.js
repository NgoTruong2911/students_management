
    $(document).on('click' , '.remove', function () {
                // console.log('subject_name');
                let subject_id = $(this).parent().find('.remove_input').data('subject_id');
                let subject_name = $(this).parent().find('.remove_input').data('subject_name');
                 console.log(subject_name);
                 console.log(subject_id);
                    $(this).parent().parent().find('.remove_input').remove();
                let li = `<li class="subject" value=${subject_id}>
                <input type="checkbox">${subject_name}</li>`
                    $('.subject-list').children().append(li);
                //  console.log($('.subject-list').children());
            })
            $(document).on('click','.subject', function () {
                // console.log('subject');
    const html = ` <div class="form-group">
                        <ul class="list-group  w-45">
                            <li class="remove_input"><label
                                    for="${$(this).val()}">${$(this).text()}</label></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center remove_input">
                                <input type="number"
                                        name="subject_point[${$(this).val()}][point]"
                                        class="form-control mt-4 remove_input" readonly value="0"
                                        data-subject_id="${$(this).val()}"
                                        data-subject_name="${$(this).text()}" id="${$(this).val()}" >
                                <button type="button" class="remove btn btn-link "><span
                                        class="badge badge-primary badge-pill"><i
                                            class="fa fa-times"
                                            aria-hidden="true"></i></span></button>
                                <input type="hidden" value="${$(this).text()}" name="subject_name_hidden[]">
                                <input type="hidden" value="${$(this).val()}" name="subject_id[]">
                                <input type="hidden" name="point[]">
                            </li>
                        </ul>
                    </div>`
    $('.list-edit-subjects').append(html);
                $(this).hide();
            })

