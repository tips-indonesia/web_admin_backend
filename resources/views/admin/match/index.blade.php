@extends('admin.app')

@section('title')
    Match
@endsection
@section('page_title')
    <span class="text-semibold">Match</span>
@endsection
@section('content')
    <!-- Vertical form options -->
    <style type="text/css">
        .dtitlepicker{
            margin-bottom: 8px;
        }
        .dselectpicker .selectpicker, .dselectpicker .bootstrap-select{
            width: 100% !important;
        }
        .shipment .col-md-3{
            background: rgba(0, 0, 0, .2);
        }
        .shipment .col-md-9{
            background: rgba(0, 0, 0, .1);
        }

        .shipment .col-md-3, .shipment .col-md-9{
            border-bottom: solid 1px rgba(0, 0, 0, .25);
        }

        .delete-matched{
            cursor: pointer;
        }
        /* Start by setting display:none to make this hidden.
           Then we position it in relation to the viewport window
           with position:fixed. Width, height, top and left speak
           for themselves. Background we set to 80% white with
           our animation centered, and no-repeating */
        #loading_modal{
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 99999;
            font-size: 2em;
            color: #FFF;
            padding: 10%;
            background: rgba(0, 0, 0, .2);
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">

                <div class="panel-body">
                    <div class="shipment">
                        <div class="dtitlepicker">
                            <span>
                                Slot
                            </span>
                        </div>
                        <div class="dselectpicker">
                            <select id="slotxpicker" class="selectpicker" data-live-search="true">
                            </select>
                        </div>
                        <br/>
                        <div id="slot_kvs" style="margin: 0px 8px"></div>
                    </div>
                </div>

                <style type="text/css">
                    .scroller{
                        height: 350px;
                        border: solid 1px rgba(0, 0, 0, .1);
                        overflow-y: scroll;
                    }
                    .scroller .shipment-row{
                        background: rgba(0, 0, 0, .15);
                        padding: 5px;
                        border-radius: 3px;
                        margin: 5px 10px;
                        border: solid 1px rgba(0, 0, 0, .5); 
                    }
                    .scroller .shipment-row .sp-row-data{
                        
                    }
                    .scroller .shipment-row .add{
                        color: white;
                        font-weight: bold;
                        cursor: pointer;
                        background: rgba(20, 213, 132, 1);
                    }
                    .scroller .shipment-row .add:hover{
                        background: rgba(20, 225, 132, 1);
                    }
                </style>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 shipment">
                            <div id="scroller" class="scroller">
                                
                            </div>
                        </div>
                        <div class="col-md-6 shipment">
                            <div id="matched_scroller" class="scroller">
                                
                            </div>
                        </div>
                    </div>
                </div>

                <br/>
                <div class="panel-body">
                    <div>
                        <div id="save" class="btn btn-warning" style="float: right;">
                            Posting
                        </div>
                    </div>
                </div>
                <br/>
            <!-- /WYSIHTML5 basic -->
            </div>
        </div>
    </div>
    <script>
        $(document).ready(() => {
            console.log("ready-me");
            let endpoint_url = "{!! URL::to('/api/') !!}" + "/";
            var airport_city_list = [];
            let shipment_saved_data = [];
            let shipment_matched_saved_data = [];
            var slot_saved_data = [];
            let indexed_city_list = [];

            let LAST_SLOT_INDEX = 0;

            var current_active_slot;


            $('#slotxpicker').change(function() {
                let slot_data = findSlotById(this.value);
                if(slot_data != null){
                    console.log(slot_data);
                    current_active_slot = slot_data;
                    populateShipmentAndView(slot_data.id);
                    LAST_SLOT_INDEX = $(this).prop('selectedIndex');
                }
            });

            $('#save').click((e) => {
                e.preventDefault();
                postingMatching(() => {
                    location.reload();
                });
            });

            var isFunction = (f) => {return f && {}.toString.call(f) === '[object Function]';}

            var createIndexedCityList = (callback) => {
                let len = airport_city_list.length; // DEPENDENCY
                for(let i = 0; i < len; i++)
                    indexed_city_list[airport_city_list[i].id] = airport_city_list[i].name; // DEPENDENCY

                console.log(indexed_city_list); // DEPENDENCY
                if(isFunction(callback))
                            callback();
            }

            var findShipmentById = (id) => {
                let len = shipment_saved_data.length; // DEPENDENCY
                for (var i = 0; i < len; i++){
                    if(shipment_saved_data[i].id == id){ // DEPENDENCY
                        return shipment_saved_data[i]; // DEPENDENCY
                    }
                }

                return null;
            }

            var findSlotById = (id) => {
                let len = slot_saved_data.length; // DEPENDENCY
                for (var i = 0; i < len; i++){
                    if(slot_saved_data[i].id == id){ // DEPENDENCY
                        return slot_saved_data[i]; // DEPENDENCY
                    }
                }

                return null;
            }

            var findTheCity = (cid) => {
                let city_name = indexed_city_list[cid]; // DEPENDENCY
                if(city_name)
                    return city_name;

                return "error: city undefined";
            }

            var shipmentIsEmpty = () => {
                return shipment_matched_saved_data.length == 0;
            }

            var postingMatching = (callback) => {
                if(shipmentIsEmpty){
                    alert("Shipment tidak boleh kosong")
                    return;
                }
                
                let url = endpoint_url + "match/posting_matching";

                $.ajax({
                    "url": url,
                    "type": "GET",
                    "data": {
                        "slot_id": current_active_slot.id
                    },
                    "beforeSend": function(xhr){
                        xhr.setRequestHeader('Content-Type', 'application/json');
                    },
                    "success": (data) => {
                        if(!data.err){
                            if(isFunction(callback))
                                callback();
                        }else{
                            alert(data.err.message);
                        }
                    }
                });
            }

            var submitMatching = (id_shipment, callback) => {
                let url = endpoint_url + "match/submit_matching";

                $.ajax({
                    "url": url,
                    "type": "GET",
                    "data": {
                        "id_shipment": id_shipment,
                        "id_slot": current_active_slot.id
                    },
                    "beforeSend": function(xhr){
                        xhr.setRequestHeader('Content-Type', 'application/json');
                    },
                    "success": (data) => {
                        if(!data.err){
                            if(isFunction(callback))
                                callback();
                        }else{
                            alert(data.err.message);
                        }
                    }
                });
            }

            var unSubmitMatching = (id_shipment, callback) => {
                let url = endpoint_url + "match/un_submit_matching";

                $.ajax({
                    "url": url,
                    "type": "GET",
                    "data": {
                        "id_shipment": id_shipment,
                        "id_slot": current_active_slot.id
                    },
                    "beforeSend": function(xhr){
                        xhr.setRequestHeader('Content-Type', 'application/json');
                    },
                    "success": (data) => {
                        if(!data.err){
                            if(isFunction(callback))
                                callback();
                        }else{
                            alert(data.err.message);
                        }
                    }
                });
            }

            // get airport city list data, callback with result as parameter
            var getInitAirportCityList = (callback) => {
                let url = endpoint_url + "location/airportcity";
                $.ajax({
                    "url": url,
                    "type": "GET",
                    "beforeSend": function(xhr){
                        xhr.setRequestHeader('Content-Type', 'application/json');
                    },
                    "success": (data) => {
                        var acl = data.result;
                        if(isFunction(callback))
                            callback(acl);
                    }
                });
            }
            
            // get all shipment data, callback with result as parameter
            var getInitShipmentData = (callback) => {
                let url = endpoint_url + "shipment/all";

                $.ajax({
                    "url": url,
                    "type": "GET",
                    "beforeSend": function(xhr){
                        xhr.setRequestHeader('Content-Type', 'application/json');
                    },
                    "success": (data) => {
                        var shipments = data.result;
                        integrate_city_data(shipments);
                        console.log("Shipments list", shipments);
                        if(isFunction(callback))
                            callback(shipments);
                    }
                });
            }

            // Get all slot data, callback with result as parameter
            var getInitSlotData = (callback) => {
                let url = endpoint_url + "match/all_slot";

                $.ajax({
                    "url": url,
                    "type": "GET",
                    "beforeSend": function(xhr){
                        xhr.setRequestHeader('Content-Type', 'application/json');
                    },
                    "success": (data) => {
                        var slots = data.result;
                        console.log("Slot list", slots);
                        if(isFunction(callback))
                            callback(slots);
                    }
                });
            } 

            // Get all shipment data related to slot, using dependency
            var getShipmentRelatedToSlot = (id_slot, callback) => {
                let url = endpoint_url + "match/find_shipment";

                $.ajax({
                    "url": url,
                    "type": "GET",
                    "data": {
                        "slot_id": id_slot // DEPENDENCY
                    },
                    "beforeSend": function(xhr){
                        xhr.setRequestHeader('Content-Type', 'application/json');
                    },
                    "success": (data) => {
                        var slots = data.result;
                        console.log("Slot list", slots);
                        if(isFunction(callback))
                            callback(slots);
                    }
                });
            }

            // Get all shipment data related to slot, using dependency
            var getShipmentHasMatchedToSlot = (id_slot, callback) => {
                let url = endpoint_url + "match/find_shipment_slot_matched";

                $.ajax({
                    "url": url,
                    "type": "GET",
                    "data": {
                        "slot_id": id_slot // DEPENDENCY
                    },
                    "beforeSend": function(xhr){
                        xhr.setRequestHeader('Content-Type', 'application/json');
                    },
                    "success": (data) => {
                        var slots = data.result;
                        console.log("Slot list", slots);
                        if(isFunction(callback))
                            callback(slots);
                    }
                });
            }
            
            // Get all slot data related to shipment, using dependency
            var getSlotByShipmentId = (id_tips_booking, callback) => {
                let url = endpoint_url + "match/find_slot";

                $.ajax({
                    "url": url,
                    "type": "GET",
                    "data": {
                        "id": id_tips_booking // DEPENDENCY
                    },
                    "beforeSend": function(xhr){
                        xhr.setRequestHeader('Content-Type', 'application/json');
                    },
                    "success": (data) => {
                        var slots = data.result;
                        console.log("Slot list", slots);
                        if(isFunction(callback))
                            callback(slots);
                    }
                });
            }

            // integrating city as index mapped to string city name
            var integrate_city_data = (data) => {
                data.forEach((shipment) => {
                    shipment["city_origin_name"] = findTheCity(shipment.id_origin_city);  // DEPENDENCY
                    shipment["city_destination_name"] = findTheCity(shipment.id_destination_city);  // DEPENDENCY
                });
            }

            var populateSlotData = (datas, callback) => {
                $('#slotxpicker').html("");

                if(datas){
                    let len = datas.length;
                    for(var j = 0; j < len; j++){
                        var data = datas[j];
                        console.log("slotx::: ", data);
                        $('#slotxpicker')
                        .append('<option value="' + data.id + '">ID: ' + data.slot_id + ', BK:' + data.booking_code + ', DEP:' + data.depature + ' (' + data.origin_city + '->' + data.destination_city + ') Baggage Space: ' + data.baggage_space + ' Kg, Sold: ' + data.sold_baggage_space + ' Kg, Left: ' + (data.baggage_space - data.sold_baggage_space) + ' Kg' + '</option>');
                    }
                }
                $('#slotxpicker').selectpicker('refresh');
                $('#slotxpicker').selectpicker('render');
                if(isFunction(callback))
                    callback();
            }

            var refreshShipmentView = () => {
                $('#scroller').html('');
                let len = shipment_saved_data.length;
                for(var i = 0; i < len; i++)
                    addShipmentToScroller(shipment_saved_data[i]);
            }

            var refreshShipmentMatchedView = () => {
                $('#matched_scroller').html('');
                let len = shipment_matched_saved_data.length;
                for(var i = 0; i < len; i++)
                    addShipmentToScrollerMatched(shipment_matched_saved_data[i]);
            }

            var populateShipmentAndBindToView = (id_slot) => {
                getShipmentRelatedToSlot(id_slot, (shipments) => {
                    $('#scroller').html('');
                    shipment_saved_data = shipments;
                    integrate_city_data(shipment_saved_data);
                    refreshShipmentView();
                });
            }

            var populateShipmentMatchedAndBindToView = (id_slot) => {
                getShipmentHasMatchedToSlot(id_slot, (shipments) => {
                    $('#matched_scroller').html('');
                    shipment_matched_saved_data = shipments;
                    integrate_city_data(shipment_matched_saved_data);
                    refreshShipmentMatchedView();
                });
            }

            var populateShipmentAndView = (id_slot) => {
                populateShipmentAndBindToView(id_slot);
                populateShipmentMatchedAndBindToView(id_slot);
            }

            var move_a_to_b = (id) => {
                let len = shipment_saved_data.length;
                for(var i = 0; i < len; i++)
                    if(shipment_saved_data[i].id == id){
                        let processed_data = shipment_saved_data.splice(i, 1)[0];
                        shipment_matched_saved_data.push(processed_data);
                        current_active_slot.sold_baggage_space = parseFloat(current_active_slot.sold_baggage_space) + parseFloat(processed_data.real_weight);
                        break;
                    }
            }

            var move_b_to_a = (id) => {
                let len = shipment_matched_saved_data.length;
                for(var i = 0; i < len; i++)
                    if(shipment_matched_saved_data[i].id == id){
                        let processed_data = shipment_matched_saved_data.splice(i, 1)[0];
                        shipment_saved_data.push(processed_data);
                        current_active_slot.sold_baggage_space = parseFloat(current_active_slot.sold_baggage_space) - parseFloat(processed_data.real_weight);
                        break;
                    }
            }

            var createScrollerChild = (teks, id) => {
                return '<div class="shipment-row row">\
                            <div class="sp-row-data col-md-11">'
                                + teks +
                            '</div>\
                            <div id="shipment_' + id + '" data-shipmentid="' + id + '" class="add btn-add col-md-1 primary">\
                                Add\
                            </div>\
                        </div>';
            }

            var createScrollerMatchedChild = (teks, id) => {
                return '<div class="shipment-row row">\
                            <div class="sp-row-data col-md-11">'
                                + teks +
                            '</div>\
                            <div id="shipment_' + id + '" data-shipmentid="' + id + '" class="add btn-del col-md-1 primary" style="background: #F04465">\
                                Del\
                            </div>\
                        </div>';
            }

            var addShipmentToScroller = (data) => {
                $('#scroller').append(createScrollerChild(data.shipment_id + ' (' + data.city_origin_name + '->' + data.city_destination_name + ') Real Weight: ' + data.real_weight + ' Kg', data.id));
            }
            var addShipmentToScrollerMatched = (data) => {
                $('#matched_scroller').append(createScrollerMatchedChild(data.shipment_id + ' (' + data.city_origin_name + '->' + data.city_destination_name + ') Real Weight: ' + data.real_weight + ' Kg', data.id));
            }

            var startListener = () => {
                $(document).on('click', '.btn-add', function(){
                    let shipment_id = $(this).data("shipmentid");
                    submitMatching(shipment_id, () => {
                        move_a_to_b(shipment_id);
                        refreshShipmentView();
                        refreshShipmentMatchedView();
                        populateSlotData(slot_saved_data, () => {
                            $('#slotxpicker').prop('selectedIndex', LAST_SLOT_INDEX);
                            $('#slotxpicker').selectpicker('refresh');
                            $('#slotxpicker').selectpicker('render');
                        });
                    });
                });
                $(document).on('click', '.btn-del', function(){ 
                    let shipment_id = $(this).data("shipmentid");
                    unSubmitMatching(shipment_id, () => {
                        move_b_to_a(shipment_id);
                        refreshShipmentView();
                        refreshShipmentMatchedView();
                        populateSlotData(slot_saved_data, () => {
                            $('#slotxpicker').prop('selectedIndex', LAST_SLOT_INDEX);
                            $('#slotxpicker').selectpicker('refresh');
                            $('#slotxpicker').selectpicker('render');
                        });
                    });
                });
            }

            // Main Function
            (() => {
                getInitAirportCityList((acl) => {
                    airport_city_list = acl;
                    createIndexedCityList(() => {
                        // no return parameter on callback, processed on global
                        getInitSlotData((slots) => {
                            slot_saved_data = slots;
                            populateSlotData(slot_saved_data);

                            // init listener appened element
                            startListener();

                            // init first data
                            if(slot_saved_data.length > 0){
                                populateShipmentAndView(slot_saved_data[0].id);
                                current_active_slot = slot_saved_data[0];
                            }
                        });
                    });
                });
            })();






            // ___________----------========
        });
    </script>
@endsection
