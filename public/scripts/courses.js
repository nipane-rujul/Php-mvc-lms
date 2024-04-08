$(document).ready(function () {
    let courses = [];
    console.log("hi");
    $('#spinner').show();
    $.get(
        
        "getCourses",
        function (response) {
            $('#spinner').hide();
            courses = response;
            console.log(courses);
            if (courses === null) {
                // $("#course-head").style.display = "none";
                console.log($("#course-head").addClass("visually-hidden"));
                $(".row").html("<h4 class='text-center mt-5'>No Courses to display</h4>");
            }
            else {
                // console.log($("#course-head").removeClass("visually-hidden"));
                // display course cards on page
                courses.forEach(function (course) {
                    const cardTemplate = $("#admin-card").length ? $("#admin-card") : $("#user-card");
                    const newCard = cardTemplate.clone().appendTo(".row");
                    newCard.attr("data-course-id", course['id']);
                    newCard.find(".btn-edit").attr("data-course-id", course['id']);
                    newCard.find(".btn-delete").attr("data-course-id", course['id']);
                    // newCard.find("img").attr("src", course['url']);
                    newCard.find(".card-title").text(course['title']);
                    newCard.find(".card-text").text(course['details']);
                    newCard.find("a").attr("href", "course?id=" + course['id']);
                    newCard.removeClass("visually-hidden");
                });
            }
        },
        "json"
    ).fail(function (xhr, status, error) {
        console.error("Error:", error);
    });

    // function to delete course 
    $(document).on("click", ".btn-delete", function (e) {
        e.preventDefault();
        var course_id = $(this).data('course-id');
        if (confirm("Are you sure you want to delete this Course?")) {
            $.post("deleteCourse",
                {
                    id: course_id
                }, function (res, status) {
                    console.log(res);

                }, 'json').fail(function (xhr, status, error) {
                    console.log(error);
                })

            $(this).closest('.col-md-6').remove();
        }
    });

    // function to edit course 
    $(document).on("click", ".btn-edit", function (e) {
        e.preventDefault();
        var course_id = $(this).data('course-id');
        window.location.href = `editCourse?id=${course_id}`;
    });
});



