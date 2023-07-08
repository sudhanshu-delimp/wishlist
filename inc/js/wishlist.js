jQuery(document).ready(function ($) {
  $(".add_wishlist_btn").on("click", function () {
    let element_object = $(this);
    let product_id = element_object.data("product-id");
    let brand_id = element_object.data("brand-id");
    let data = {};
    let is_add_wishlist = element_object.hasClass("add_wishlist");
    data["action"] = is_add_wishlist
      ? "ilola_add_to_wishlist"
      : "ilola_remove_from_wishlist";
    data["product_id"] = product_id;
    data["brand_id"] = brand_id;
    $.ajax({
      method: "POST",
      url: ilola.action_url,
      data: data,
      dataType: "json",
      beforeSend: function () {
        // console.log(data);
      },
      success: function (response) {
        if (response.status == 1) {
          let is_move_wishlist = element_object.hasClass("move_wishlist_btn");
          let string = "";
          if (is_move_wishlist == false) {
            string += is_add_wishlist
              ? '<i class="fa-solid fa-heart"></i>'
              : '<i class="fa-regular fa-heart"></i>';
          }
          string += is_add_wishlist
            ? "Added to the Wishlist"
            : "Add to Wishlist";
          if (is_add_wishlist) {
            element_object
              .removeClass("add_wishlist")
              .addClass("remove_wishlist");
          } else {
            element_object
              .removeClass("remove_wishlist")
              .addClass("add_wishlist");
          }
          element_object.html(string);
          toastr.success(response.message);
          if (is_move_wishlist == true) {
            sessionStorage.setItem("is_moved_wishlist", "yes");
            element_object.parent().next().find("a").trigger("click");
          }
        } else {
          toastr.error(response.message);
        }
      },
    });
  });

  $(document).on("click", ".delete_wishlist_btn", function (e) {
    e.preventDefault();
    let element_object = $(this);
    let wishlist_id = element_object.data("wishlist-id");
    let product_id = element_object.data("product-id");
    let data = {};
    data["action"] = "ilola_delete_product_wishlist";
    data["wishlist_id"] = wishlist_id;
    $.ajax({
      type: "POST",
      url: ilola.action_url,
      data: data,
      dataType: "json",
      beforeSend: function () {
        element_object.text("Wait...");
        // console.log(data);
      },
      success: function (response) {
        if (response.status == 1) {
          element_object.parents("#item" + product_id).remove();
          toastr.success(response.message);
          if ($(".wishlist_item").length == 0) {
            let string =
              '<h1 class="fbo-empty-notification" style="margin-top: 20px"><center>No Products Found</center></h1>';
            $(".scroll-content").html(string);
          }
        } else {
          toastr.error(response.message);
        }
      },
    });
  });

  $(document).on("click", ".btn-add-wishlist", function (e) {
    e.preventDefault();
    let element_object = $(this);
    let wishlist_id = element_object.data("wishlist-id");
    let product_id = element_object.data("product-id");
    let data = {};
    data["action"] = "ilola_delete_product_wishlist";
    data["wishlist_id"] = wishlist_id;
    $.ajax({
      type: "POST",
      url: ilola.action_url,
      data: data,
      dataType: "json",
      beforeSend: function () {
        element_object.text("Wait...");
        // console.log(data);
      },
      success: function (response) {
        if (response.status == 1) {
          element_object.parents("#item" + product_id).remove();
          toastr.success(response.message);
          if ($(".wishlist_item").length == 0) {
            let string =
              '<h1 class="fbo-empty-notification" style="margin-top: 20px"><center>No Products Found</center></h1>';
            $(".scroll-content").html(string);
          }
        } else {
          toastr.error(response.message);
        }
      },
    });
  });
});
