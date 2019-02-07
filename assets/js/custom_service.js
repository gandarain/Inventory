/** 
 * Response Code (copy from constants.php)
 */
const _ERROR = 0;
const _SUCCESS = 1;
const _WARNING = 2;
const _INFO = 3;

/**
 * Do Action (Delete, Approve, Cancel etc)
 */
function doAction(e, element, link, refresh = true) {
    if(e) {
        e.preventDefault();
    }

    var action = element.attr('title') || element.attr('data-original-title') || element.text();

    if(!confirm(`Are you sure want to ${action}?`))
        return false;

    $.ajax({url:link + "/" + Math.random()}).done(function(res) {
        let is_json = safelyJSONChecker(res);

        if(is_json.flag) {
            res = is_json.data;
            if(res.status === _SUCCESS) {
                if(refresh === true) {
                    if(res.redirect) {
                        window.location = res.redirect;
                    } else {
                        setTimeout(function() { window.location.reload(); }, 1500);
                    }
                }
            } else {
                handlingNotification(res);
            }
        }

    }).fail(function() {
        showNotification('System cannot proceed your request, please try again later', _INFO);
    });
}

/**
 * Submit Form (using POST)
 * @param {event} e - JQuery event object
 * @param {string} form_selector - JQuery Element Selector for form (eg: id => #idstring)
 * @param {string} link - Target Link
 * @param {string} msg_selector - JQuery Element Selector for error messages (must be div)
 * @param {boolean} refresh - Refresh Options
 */
function submitForm(e, form_selector, link, msg_selector = null, refresh = true) {
    if(e) {
        e.preventDefault();
    }

    $.ajax({
        url: link + "/" + Math.random(),
        data: $(form_selector).serialize() + "&submit=1",
        type: "POST"
    }).done(function(res) {
        let is_json = safelyJSONChecker(res);

        if(is_json.flag) {
            res = is_json.data;
            if(res.status == _SUCCESS) {
                if(refresh == true) {
                    if(res.redirect) {
                        window.location = res.redirect;
                    } else {
                        setTimeout(function() { window.location.reload() }, 100); 
                    }
                } else {
                    if(msg_selector !== null) {
                        $(msg_selector).css("color", "red");
                        $(`div${msg_selector}`).html(res.message);
                    } else {
                        showNotification(res.message, res.status);
                    }
                }
            } else {
                if(msg_selector !== null) {
                    $(msg_selector).css("color", "red");
                    $(`div${msg_selector}`).html(res.message);
                } else {
                    showNotification(res.message, res.status);
                }            
            }
        }
    }).fail(function() {
        showNotification('System cannot proceed your request, please try again later', _INFO);
    });
}

/**
 * Create HTTP Request via Ajax
 * @param {string} uri - Request Target (URL)
 * @param {object/string} data - Ajax Request Data
 * @param {string} type - Request Method (eg. POST, GET etc.)
 * @param {boolean} refresh - Refresh page when success
 * @return {object} Response
 */
function sendAjax(uri, data, type = '', refresh = false) {
    if(!type) {
        type = "POST";
    }

    let processRequest = $.ajax({
        url: uri + "/" + Math.random(),
        data: data,
        type: type,
        async: refresh
    }).done(function(res) {
        let is_json = safelyJSONChecker(res);

        if(is_json.flag) {
            res = is_json.data;
            if(res.status == _SUCCESS) {
                if(refresh === true) {
                    setTimeout(function() { window.location.reload() }, 100); 
                }
            } else {
                showNotification(res.message, res.status);
            }
        }
    }).fail(function(err) {
        showNotification(err.status + ' ' + err.statusText, _INFO);
    });

    if(refresh === false && processRequest.status == 200) {
        // just return responseText
        let is_json = safelyJSONChecker(processRequest.responseText);
        let object_result = is_json.data;
        return object_result;
    } else {
        return false;
    }
}

/**
 * Safely Checking JSON (is Variable is JSON)
 * @param {string} json_string - JSON Format String
 * @return {object} flag and data
 */
function safelyJSONChecker(json_string = '', reverse = false)
{
    let result = {};
    try {
        let is_json = JSON.parse(json_string);
        result.flag = true;
        result.data = is_json;
    } catch(err) {
        result.flag = false;
        result.data = json_string;
    }

    return result;
}

/**
 * Show Modal
 * @param {object} modalProps (required) - Modal Properties
 *      @props id {string} - id attribute of modal
 *      @props title {string} - Modal title
 *      @props body {string} - full URL / html string
 *      @props buttons {array} - Buttons
 *      @props size {string} - Modal bootstrap size class
 */
function showModal(modalProps, withSubmit = false) {
    let modalID = modalProps['id'] || 'main-modal';
    let modalTitle = modalProps['title'] || 'Modal Title';
    let modalBody = modalProps['body'] || 'Modal Body';
    let modalSize = modalProps['size'] || 'modal-lg';

    let isFullURL = /http/.test(modalBody);
    if(isFullURL) {
        modalBody += '/' + Math.random();
        $(`#${modalID} .modal-body`).load(modalBody);
    } else {
        $(`#${modalID} .modal-body`).html(modalBody);
    }

    $(`#${modalID} .modal-title`).html(modalTitle);
    $(`#${modalID} .modal-dialog`).addClass(modalSize);

    if(modalProps.hasOwnProperty('buttons')) {
        $(`#${modalID} div.modal-footer`).html('');

        let buttons = modalProps.buttons;
        for(let b in buttons) {
            $(`#${modalID} div.modal-footer`).append(buttons[b]);
        }
    } else {
        $(`#${modalID} div.modal-footer`).addClass('hide');
    }

    // Show Modal
    $(`#${modalID}`).modal('show');

    /**
     * Modal Listeners
     */
    // When button close modal is clicked (this only close the current modal)
    $(`#${modalID} button.close_modal`).on('click', function() {
        $(`#${modalID}`).modal('hide');
    });
    // When Modal is hidden
    $(`#${modalID}`).on('hidden.bs.modal', function() {
        $(`#${modalID} div.modal-body`).html('');
        $(`#${modalID} div.modal-footer`).html('');
    });
}

function printWindow(uri, refresh = true) {
    $.ajax({
        url: uri
    }).done(function(resp, status, jqXHR) {
        let is_json = safelyJSONChecker(resp);
        resp = is_json.data;

        if(is_json.flag) {
            handlingNotification(resp);
        } else {
            if(resp) {
                var windowOpen = window.open(uri);
                windowOpen.addEventListener('load', function() {
                    windowOpen.print();
                    setTimeout(function() { 
                        windowOpen.close(); 
                        if(refresh === true)
                            location.reload();
                    }, 100);
                });
            } else {
                showNotification('Response Empty', 1);
            }
        }
    }).fail(function(err) {
        showNotification(err.status + ' ' + err.statusText, _INFO);
    });
}

function handlingNotification(resp) {
    let notification_options = {};

    if(resp.hasOwnProperty('notification_sticky')) {
        notification_options.hide = !resp.notification_sticky;
    }

    if(resp.hasOwnProperty('notification_class')) {
        notification_options.addclass = resp.notification_class;
    }

    let notification_title = resp.notification_title || '';

    if(typeof resp.message == 'object') {
        if(Object.keys(resp.message).length > 5) {
            notification_options.hide = false;
            notification_options.time = 10000; // 10 seconds
        }
        for (var i of resp.message) {
            showNotification(i, resp.status, notification_title, notification_options);
        }
    } else {
        showNotification(resp.message, resp.status, notification_title, notification_options);
    }
}

/*
 * Function to hide table cell value dynamicly without affect dataTables
 * @param {String} tableId - contains your table selector
 * @param {Integer} columnPrimary - contains index of primary column (as hiding base)
 * @param {Array} tdToHide - contains index of columns to hide
 */
function hideTableCells(tableId, columnPrimary, tdToHide = [], revert = false) {
    let prevPrimaryValue;
    let hideThisRow = false;

    $(tableId).find('tbody > tr').each(function() {
        let tr = $(this);
        let currPrimaryValue = tr.find('td:eq(' + columnPrimary + ')').html();

        if(prevPrimaryValue != currPrimaryValue) {
            prevPrimaryValue = currPrimaryValue;
            hideThisRow = false;
        } else {
            hideThisRow = true;
        }

        tr.find('td').each(function() {
            let td = $(this);
            let td_value = td.html();
            let new_value = '<span class="hide">' + td_value + '</span>';
            let hideCols = tdToHide.includes(td.index());

            if(revert === true) {
                let td_origin_value = td_value.replace('<span class="hide">', '');
                td_origin_value = td_origin_value.replace('</span>', '');
                if(tdToHide.length == 0 || (tdToHide.length > 0 && hideCols))
                    td.html(td_origin_value);
            } else if(hideThisRow && hideCols) {
                td.html(new_value);
            }
        });
    });
}

function showNotification(text, type = 0, title = '', customSetting = {}) {
    let title_text = '';
    let icon = '';

    switch(type) {
        case 3:
        case 'info':
            type = 'info';
            title_text = 'Information';
            icon = 'fas fa-info-circle';
            break;
        case 2:
        case 'warning':
            type = 'warning';
            title_text = 'Warning!';
            icon = 'fas fa-info-circle';
            break;
        case 1:
        case 'success':
            type = 'success';
            title_text = 'Success';
            break;
        case 0:
        case 'error':
            type = 'error';
            title_text = 'Oops!';
            icon = 'fas fa-exclamation-triangle';
            break;
        default:
            type = 'info';
            title_text = 'Notification';
            break;
    }

    title_text = (title) ? title : title_text;

    let props = {
        'title': title_text,
        'text': text,
        'icon': icon,
        'type': type,
        'width':'400px',
        'styling': 'bootstrap3',
        'nonblock': {
            'nonblock': true
        },
        'Mobile': {
            'swipeDismiss': true,
            'styling': true
        }
    }

    // to add your own pnotify notification setting :)
    if(customSetting !== null && typeof customSetting === 'object') {
        for(var key in customSetting) {
            props[key] = customSetting[key];
        }
    }

    // Remove previous PNotify
    PNotify.removeAll();

    // Show new PNotify
    new PNotify(props);
}

function dtTablesButtons() {
    let buttons = [
        {
            "extend": "colvis",
            "text": "<i class='fas fa-eye-slash white'></i> <span class='hidden'>Show/hide columns</span>",
            "className": "btn btn-white btn-primary btn-bold dt-button",
            columns: ':not(:first):not(2)'
        },
        {
            "extend": "copy",
            "text": "<i class='fas fa-copy white'></i> <span class='hidden'>Copy to clipboard</span>",
            "className": "btn btn-white btn-info btn-bold dt-button"
        },
        {
            "extend": "csv",
            "text": "<i class='fas fa-database white'></i> <span class='hidden'>Export to CSV</span>",
            "className": "btn btn-white btn-warning btn-bold dt-button"
        },
        {
            "extend": "excel",
            "text": "<i class='fas fa-file-excel white'></i> <span class='hidden'>Export to Excel</span>",
            "className": "btn btn-white btn-success btn-bold dt-button"
        },
        {
            "extend": "pdf",
            "text": "<i class='fas fa-file-pdf white'></i> <span class='hidden'>Export to PDF</span>",
            "className": "btn btn-white btn-danger btn-bold dt-button"
        },
        {
            "extend": "print",
            "text": "<i class='fas fa-print white'></i> <span class='hidden'>Print</span>",
            "className": "btn btn-white btn-info btn-bold dt-button",
            autoPrint: true,
            message: 'This print was produced using the Print button for DataTables'
        }
    ];

    return buttons;
}

// ******************** JQUERY SCRIPT *********************** //
// ************* DATEPICKER ************* //
function openDatePicker(selector) {
    selector.attr('autocomplete', 'off');
    selector.daterangepicker({
        singleDatePicker: true,
        singleClasses: "picker_3",
        showDropdowns: true,
        locale: {
            format:'DD-MM-YYYY'
        }
    }, function(start, end, label) {
      // console.log(start.toISOString(), end.toISOString(), label);
    });
}
// ************* /DATEPICKER ************* //

// ***** On Ready Script ***** //
$(document).ready(function() {
    $(".date-picker, .birth-picker, .input-daterange>input").attr('autocomplete', 'off');
});
// ******************** /JQUERY SCRIPT *********************** //
