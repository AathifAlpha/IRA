$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).ready(function () {
    // Create Todo button click event
    $("#create-todo-btn").click(function () {
        $(".error").remove();
        $("#todoId").remove();
        $("#todo-modal #modal-responsible").text("Create Todo");
        $("#todo-form")[0].reset();
        $("#todo-modal").modal("toggle");
    });

    // Form validation and submission
    $("#todo-form").validate({
        rules: {
            responsible: "required",
            employee: "required",
            procedures: "required",
        },
        messages: {
            responsible: "Please enter the responsible person",
            employee: "Please enter the Employee Name",
            procedures: "Please enter the Procedures",
        },
        submitHandler: function (form) {
            const id = $("input[name=todoId]").val();
            const formData = $(form).serializeArray();

            $.ajax({
                url: "todos",
                type: "POST",
                data: formData,
                success: function (response) {
                    if (response && response.status === "success") {
                        $("#todo-form")[0].reset();
                        $("#todo-modal").modal("toggle");
                        $("#todo-table p").empty();
                        const data = response.data;

                        if (id) {
                            // Update existing todo
                            $("#todo_" + id + " td:nth-child(2)").html(data.responsible);
                            $("#todo_" + id + " td:nth-child(3)").html(data.employee);
                            $("#todo_" + id + " td:nth-child(4)").html(data.procedures);
                        } else {
                            // Add new todo
                            $("#todo-table").prepend(
                                `<tr id="todo_${data.id}">
                                    <td>${data.id}</td>
                                    <td>${data.responsible}</td>
                                    <td>${data.employee}</td>
                                    <td>${data.procedures}</td>
                                    <td>
                                        <a href="javascript:void(0)" data-id="${data.id}" title="View" class="btn btn-sm btn-info btn-view"> View </a>
                                        <a href="javascript:void(0)" data-id="${data.id}" title="Edit" class="btn btn-sm btn-success btn-edit"> Edit </a>
                                        <a href="javascript:void(0)" data-id="${data.id}" title="Delete" class="btn btn-sm btn-danger btn-delete"> Delete </a>
                                    </td>
                                </tr>`
                            );
                        }
                    }
                },
            });
        },
    });

    // View Todo button click event
    $(document).on("click", ".btn-view", function () {
        const id = $(this).data("id");
        $("label.error").remove();
        $("input[name=responsible], textarea[name=procedures]").removeClass("error").attr("disabled", true);
        $("#todo-modal button[type=submit]").addClass("d-none");

        $.ajax({
            url: `todos/${id}`,
            type: "GET",
            success: function (response) {
                if (response && response.status === "success") {
                    const data = response.data;
                    $("#todo-modal #modal-responsible").text("Medication Detail");
                    $("#todo-modal input[name=responsible]").val(data.responsible);
                    $("#todo-modal textarea[name=procedures]").val(data.procedures);
                    $("#todo-modal").modal("toggle");
                }
            },
        });
    });

    // Edit Todo button click event
    $(document).on("click", ".btn-edit", function () {
        const id = $(this).data("id");
        $("label.error").remove();
        $("#status-dropdown").remove();
        $("input[name=responsible], textarea[name=procedures]").removeClass("error").removeAttr("disabled");
        $("#todo-modal button[type=submit]").removeClass("d-none");

        $.ajax({
            url: `todos/${id}`,
            type: "GET",
            success: function (response) {
                if (response && response.status === "success") {
                    const data = response.data;
                    $("#todo-modal #modal-responsible").text("Update Todo");
                    $("#todo-modal input[name=responsible]").val(data.responsible);
                    $("#todo-modal textarea[name=procedures]").val(data.procedures);

                    const selectDropdown = `
                        <div id="status-dropdown" class="form-group my-3">
                            <label for="procedures"> Completed </label>
                            <select class="form-select">
                                <option value="1" ${data.is_completed === 1 ? 'selected' : ''}>Yes</option>
                                <option value="0" ${data.is_completed === 0 ? 'selected' : ''}>No</option>
                            </select>
                        </div>`;
                    $("#todo-modal textarea[name=procedures]").after(selectDropdown);
                    $("#todo-modal").modal("toggle");
                }
            },
        });
    });

    // Delete Todo button click event
    $(document).on("click", ".btn-delete", function () {
        const id = $(this).data("id");
        if (confirm("Are you sure you want to delete this todo?")) {
            $.ajax({
                url: `todos/${id}`,
                type: "DELETE",
                success: function (response) {
                    if (response && response.status === "success") {
                        $(`#todo_${id}`).remove();
                    }
                },
            });
        }
    });
});
