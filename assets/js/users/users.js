$(document).ready(function () {
  var url = base_url() + "users/show";
  var columns = [
    { data: "username" },
    { data: "email" },
    {
      data: "status",
      render: function (data) {
        return data == 1
          ? '<div class="badge badge-light-success">Active</div>'
          : '<div class="badge badge-light-danger">Tidak Active</div>';
      },
    },
    { data: "action", width: "17%" },
  ];

  gridDatatables(url, columns);

  $("#btnAdd").on("click", function () {
    var url = $(this).data("url");
    window.location.href = url;
  });

  $(document).on("click", ".view-menu-access", function () {
    var url = $(this).data("url");
    window.location.href = url;
  });
});

let permissionState = {};

function savePermissionStateToLocalStorage() {
  const userId = $("#user_id").val();
  const stateKey = `permission_state_user_${userId}`;
  localStorage.setItem(stateKey, JSON.stringify(permissionState));
}

function loadPermissionStateFromLocalStorage() {
  const userId = $("#user_id").val();
  const stateKey = `permission_state_user_${userId}`;
  const storedState = localStorage.getItem(stateKey);
  if (storedState) {
    permissionState = JSON.parse(storedState);
  }
}

function updatePermissionState(menuId, perm, value) {
  if (!permissionState[menuId]) {
    permissionState[menuId] = {};
  }
  permissionState[menuId][perm] = value ? 1 : 0;
  savePermissionStateToLocalStorage(); // Simpan setiap update
}

function getChecked(menuId, perm, originalValue) {
  if (permissionState[menuId] && permissionState[menuId][perm] !== undefined) {
    return permissionState[menuId][perm] ? "checked" : "";
  }
  return originalValue ? "checked" : "";
}

// $(document).on("click", ".view-menu-access", function () {
//   buttonAction($(this));

//   const userId = $("#user_id").val();
//   const storageKey = `menu_data_user_${userId}`;
//   let $input = $("#nama_menu");
//   let $clear = $("#clearNamaMenu");

//   // ===== FILTER DAN CLEAR =====
//   $(document)
//     .off("keyup", "#nama_menu")
//     .on("keyup", "#nama_menu", function () {
//       const keyword = $(this).val().trim().toLowerCase();
//       $clear.toggle(keyword.length > 0);
//       filterMenu(keyword, storageKey);
//     });

//   $(document)
//     .off("click", "#clearNamaMenu")
//     .on("click", "#clearNamaMenu", function () {
//       $input.val("");
//       $(this).hide();
//       filterMenu("", storageKey);
//       $input.focus();
//     });

//   $(document)
//     .off("change", "#kt_roles_select_all")
//     .on("change", "#kt_roles_select_all", function () {
//       const checked = $(this).is(":checked");
//       $(".check-all, .perm-checkbox,.select-all-per-row").prop(
//         "checked",
//         checked
//       );
//       $(".perm-checkbox").each(function () {
//         const nameAttr = $(this).attr("name");
//         const menuIdMatch = nameAttr.match(/permissions\[(\d+)\]/);
//         const permMatch = nameAttr.match(/\[(\w+)\]$/);
//         if (menuIdMatch && permMatch) {
//           updatePermissionState(menuIdMatch[1], permMatch[1], checked);
//         }
//       });
//     });

//   $(document)
//     .off("change", ".select-all-per-row")
//     .on("change", ".select-all-per-row", function () {
//       const group = $(this).data("group");
//       const checked = $(this).is(":checked");
//       const $checkboxes = $('input.perm-checkbox[data-group="' + group + '"]');
//       $checkboxes.prop("checked", checked);
//       $checkboxes.each(function () {
//         const nameAttr = $(this).attr("name");
//         const menuIdMatch = nameAttr.match(/permissions\[(\d+)\]/);
//         const permMatch = nameAttr.match(/\[(\w+)\]$/);
//         if (menuIdMatch && permMatch) {
//           updatePermissionState(menuIdMatch[1], permMatch[1], checked);
//         }
//       });
//       $("#" + group).prop("checked", checked);
//     });

//   $(document)
//     .off("change", ".check-all")
//     .on("change", ".check-all", function () {
//       const group = $(this).attr("id");
//       const checked = $(this).is(":checked");
//       const $permsInGroup = $(
//         'input.perm-checkbox[data-group="' + group + '"]'
//       );
//       const $viewCheckbox = $permsInGroup.filter(function () {
//         return $(this)
//           .attr("name")
//           ?.match(/\[view\]$/);
//       });
//       const $otherCheckboxes = $permsInGroup.not($viewCheckbox);

//       $viewCheckbox.prop("checked", checked);
//       $viewCheckbox.each(function () {
//         const nameAttr = $(this).attr("name");
//         const menuIdMatch = nameAttr.match(/permissions\[(\d+)\]/);
//         if (menuIdMatch) {
//           updatePermissionState(menuIdMatch[1], "can_view", checked);
//         }
//       });

//       if (!checked) {
//         $otherCheckboxes.each(function () {
//           const nameAttr = $(this).attr("name");
//           const menuIdMatch = nameAttr.match(/permissions\[(\d+)\]/);
//           const permMatch = nameAttr.match(/\[(\w+)\]$/);
//           if (menuIdMatch && permMatch) {
//             updatePermissionState(menuIdMatch[1], permMatch[1], false);
//           }
//         });
//         $otherCheckboxes.prop("checked", false);
//       }
//     });

//   $(document)
//     .off("change", ".perm-checkbox")
//     .on("change", ".perm-checkbox", function () {
//       const group = $(this).data("group");
//       const $allPerms = $('input.perm-checkbox[data-group="' + group + '"]');
//       const $checkAll = $("#" + group);
//       const nameAttr = $(this).attr("name");
//       const checked = $(this).is(":checked");
//       const match = nameAttr.match(/\[(\w+)\]$/);
//       const currentPerm = match ? match[1] : null;

//       if (currentPerm === "can_view") {
//         $checkAll.prop("checked", checked);
//         if (!checked) {
//           $allPerms.not(this).prop("checked", false);
//         }
//       } else {
//         if (checked) {
//           const $viewCheckbox = $allPerms.filter(function () {
//             return $(this)
//               .attr("name")
//               ?.match(/\[view\]$/);
//           });
//           $viewCheckbox.prop("checked", true);
//           $checkAll.prop("checked", true);
//         } else {
//           const otherChecked =
//             $allPerms.filter(function () {
//               return (
//                 !$(this)
//                   .attr("name")
//                   .match(/\[view\]$/) && $(this).is(":checked")
//               );
//             }).length > 0;
//           if (!otherChecked) {
//             $checkAll.prop("checked", false);
//             $allPerms
//               .filter(function () {
//                 return $(this)
//                   .attr("name")
//                   ?.match(/\[view\]$/);
//               })
//               .prop("checked", false);
//           }
//         }
//       }

//       const menuIdMatch = nameAttr.match(/permissions\[(\d+)\]/);
//       if (menuIdMatch && currentPerm) {
//         updatePermissionState(menuIdMatch[1], currentPerm, checked);
//       }
//     });

//   // ===== LOAD DATA PERTAMA =====
//   loadPermissionStateFromLocalStorage();

//   const cachedData = localStorage.getItem(storageKey);
//   if (cachedData) {
//     renderFullData(JSON.parse(cachedData));
//   } else {
//     $.ajax({
//       url: base_url() + "users/data_menu",
//       method: "POST",
//       data: { id: userId, _token: getCookie() },
//       success: function (response) {
//         const data = JSON.parse(response).data;

//         localStorage.setItem(storageKey, JSON.stringify(data));
//         renderFullData(data);
//       },
//       error: function () {
//         $("#menuTableBody").html(
//           '<tr><td colspan="2">Gagal memuat data</td></tr>'
//         );
//       },
//     });
//   }

//   $(document).on("click", ".parent-menu", function () {
//     const targetClass = $(this).data("target");
//     const $children = $("." + targetClass);
//     const $icon = $(this).find(".toggle-icon");
//     const isVisible = $children.first().css("display") === "table-row";

//     $children.toggle(!isVisible); // Tampilkan jika tersembunyi, sembunyikan jika terlihat
//     $icon.html(isVisible ? "&#x25BC;" : "&#x25B2;"); // Ganti ikon ▼ ▲
//   });
// });

$(document).on("click", "#btnCloseModal", function () {
  $("#modalLarge").modal("hide");

  // Hapus localStorage saat modal ditutup
  const userId = $("#user_id").val();
  const storageKey = `menu_data_user_${userId}`;
  const stateKey = `permission_state_user_${userId}`;

  localStorage.removeItem(storageKey);
  localStorage.removeItem(stateKey);

  permissionState = {};

  $("#nama_menu").val("");
  $("#clearNamaMenu").hide();
});

function renderFullData(data) {
  const html = renderMenuTable(data);
  $("#menuTableBody").html(html);
  syncPermissionState();
}

function syncPermissionState() {
  for (let menuId in permissionState) {
    for (let perm in permissionState[menuId]) {
      const isChecked = permissionState[menuId][perm] ? true : false;
      $(`input[name="permissions[${menuId}][${perm}]"]`).prop(
        "checked",
        isChecked
      );
    }
  }
}

function filterMenu(keyword, storageKey) {
  const cachedData = localStorage.getItem(storageKey);
  if (!cachedData) return;

  const data = JSON.parse(cachedData);

  if (keyword === "") {
    renderFullData(data);
    return;
  }

  const filteredMenuMap = {};
  const filteredChildrenMap = {};

  for (let id in data.menu_map) {
    const menu = data.menu_map[id];
    const name = menu.name.toLowerCase();
    const hasChildren = data.children_map[id];
    const matchingChildren = [];

    if (name.includes(keyword)) {
      filteredMenuMap[id] = menu;
      if (hasChildren) filteredChildrenMap[id] = data.children_map[id];
    } else if (hasChildren) {
      data.children_map[id].forEach((child) => {
        if (child.name.toLowerCase().includes(keyword)) {
          matchingChildren.push(child);
        }
      });
      if (matchingChildren.length > 0) {
        filteredMenuMap[id] = menu;
        filteredChildrenMap[id] = matchingChildren;
      }
    }
  }

  const filteredData = {
    menu_map: filteredMenuMap,
    children_map: filteredChildrenMap,
  };

  const html = renderMenuTable(filteredData);
  $("#menuTableBody").html(html);
  syncPermissionState();
}

function renderMenuTable(data) {
  let menu_map = data.menu_map;
  let children_map = data.children_map;
  let html = "";

  for (let menu_id in menu_map) {
    let menu = menu_map[menu_id];
    let has_children = children_map[menu_id] !== undefined;
    let menu_prefix = menu.name.toLowerCase().replace(/ /g, "_");
    let index = menu_id;
    let all_id = `check_all_${menu_prefix}_${index}`;

    let all_checked =
      getChecked(menu_id, "can_view", menu.view) ||
      getChecked(menu_id, "can_insert", menu.insert) ||
      getChecked(menu_id, "can_update", menu.update) ||
      getChecked(menu_id, "can_delete", menu.delete) ||
      getChecked(menu_id, "can_import", menu.import) ||
      getChecked(menu_id, "can_export", menu.export)
        ? "checked"
        : "";

    if (has_children) {
      let childGroupClass = `child-of-${menu_id}`;

      // Parent row with collapse trigger
      html += `<tr>
        <td colspan="2">
          <div class="parent-menu d-flex justify-content-between align-items-center text-white" data-target="${childGroupClass}" style="padding: 0.5rem 1rem; background: #2C9AFF; border-radius: 4px; font-weight: bold; cursor: pointer;">
            <span>${menu.name}</span>
            <span class="toggle-icon">&#x25B2;</span>
          </div>
        </td>
      </tr>`;

      // Render children
      children_map[menu_id].forEach((child) => {
        let child_prefix = child.name.toLowerCase().replace(/ /g, "_");
        let child_index = child.id;
        let child_all_id = `check_all_${child_prefix}_${child_index}`;
        let child_checked =
          getChecked(child.id, "can_view", child.view) ||
          getChecked(child.id, "can_insert", child.insert) ||
          getChecked(child.id, "can_update", child.update) ||
          getChecked(child.id, "can_delete", child.delete) ||
          getChecked(child.id, "can_import", child.import) ||
          getChecked(child.id, "can_export", child.export)
            ? "checked"
            : "";

        html += `<tr class="${childGroupClass}" style="display: table-row;">
          <td colspan="2" style="padding-left: 2rem;">
            <div style="border: 1px dashed #ddd; padding: 1rem; border-radius: 6px;">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <label class="form-check form-check-sm form-check-custom form-check-solid mb-0">
                  <input id="${child_all_id}" class="form-check-input check-all" type="checkbox" ${child_checked} />
                  <span class="form-check-label fw-bold">${child.name}</span>
                </label>
                <label class="form-check form-check-custom form-check-solid mb-0">
                  <input class="form-check-input select-all-per-row" type="checkbox" data-group="${child_all_id}" />
                  <span class="form-check-label">Semua</span>
                </label>
              </div>
              <hr style="border-top: 1px dashed #ccc; margin: 0.5rem 0;" />
              <div class="d-flex flex-wrap gap-4 pt-2" data-group="${child_all_id}">`;

        ["view", "insert", "update", "delete", "import", "export"].forEach(
          (perm) => {
            let input_id = `${child_prefix}_${perm}_${child_index}`;
            let is_checked = getChecked(child.id, perm, child[perm])
              ? "checked"
              : "";
            html += `<label class="form-check form-check-sm form-check-custom form-check-solid">
              <input id="${input_id}" class="form-check-input perm-checkbox" type="checkbox" name="permissions[${
              child.id
            }][${perm}]" ${is_checked} data-group="${child_all_id}" />
              <span class="form-check-label">${
                perm.charAt(0).toUpperCase() + perm.slice(1)
              }</span>
            </label>`;
          }
        );

        html += `</div></div></td></tr>`;
      });
    } else if (menu.parent == 0) {
      // Single-level menu (no children)
      html += `<tr>
        <td colspan="2">
          <div style="border: 2px dashed #ccc; padding: 1rem; border-radius: 6px;">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <label class="form-check form-check-sm form-check-custom form-check-solid mb-0">
                <input id="${all_id}" class="form-check-input check-all" type="checkbox" ${all_checked} />
                <span class="form-check-label fw-bold">${menu.name}</span>
              </label>
              <label class="form-check form-check-custom form-check-solid mb-0">
                <input class="form-check-input select-all-per-row" type="checkbox" data-group="${all_id}" />
                <span class="form-check-label">Semua</span>
              </label>
            </div>
            <hr style="border-top: 1px dashed #ccc; margin: 0.5rem 0;" />
            <div class="d-flex flex-wrap gap-4 pt-2" data-group="${all_id}">`;

      ["view", "insert", "update", "delete", "import", "export"].forEach(
        (perm) => {
          let input_id = `${menu_prefix}_${perm}_${index}`;
          let is_checked = getChecked(menu_id, perm, menu[perm])
            ? "checked"
            : "";
          html += `<label class="form-check form-check-sm form-check-custom form-check-solid">
            <input id="${input_id}" class="form-check-input perm-checkbox" type="checkbox" name="permissions[${menu_id}][${perm}]" ${is_checked} data-group="${all_id}" />
            <span class="form-check-label">${
              perm.charAt(0).toUpperCase() + perm.slice(1)
            }</span>
          </label>`;
        }
      );

      html += `</div></div></td></tr>`;
    }
  }

  return html;
}

$(document).on("click", "#btnProcessModal", function () {
  var textButton = $(this).text();
  var btn = $(this);
  var url = $("#form").data("url");
  var data = $("#form").serializeArray(); // convert form to array
  data.push({ name: "_token", value: getCookie() });

  $.ajax({
    url: url,
    method: "POST",
    dataType: "JSON",
    async: false,
    data: $.param(data),
    success: function (response) {
      if (!response.success) {
        if (!response.validate) {
          $.each(response.messages, function (key, value) {
            addErrorValidation(key, value);
          });
        }

        return;
      }

      if (typeof response.data != "undefined") {
        addDataOption(response.data);
      }

      reset_input();
      $("#table-data").DataTable().ajax.reload();
      $(btnCloseModal).trigger("click");

      if (response.validate) {
        message(response.success, response.messages);
      }

      // Hapus localStorage dan reload halaman setelah delay 2 detik
      const userId = $("#user_id").val();
      localStorage.removeItem(`menu_data_user_${userId}`);
      localStorage.removeItem(`permission_state_user_${userId}`);

      setTimeout(() => {
        location.reload();
      }, 1500);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      switch (jqXHR.status) {
        case 401:
          sweetAlertMessageWithConfirmNotShowCancelButton(
            "Your session has expired or invalid. Please relogin",
            function () {
              window.location.href = base_url();
            }
          );
          break;

        default:
          sweetAlertMessageWithConfirmNotShowCancelButton(
            "We are sorry, but you do not have access to this service",
            function () {
              location.reload();
            }
          );
          break;
      }

      // Pastikan juga hapus localStorage sebelum reload (jika perlu)
      const userId = $("#user_id").val();
      localStorage.removeItem(`menu_data_user_${userId}`);
      localStorage.removeItem(`permission_state_user_${userId}`);
    },
  });
});
