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

            <!-- WYSIHTML5 basic -->
            <!-- nanti yaaaa -->
            <div class="panel panel-flat" hidden>
                <div class="panel-body">
                    <title>Data Matched</title>
                    <div id="matched_list">
                    </div>
                    <br/>
                    <div>
                        <div class="btn btn-warning">
                            Submit All Matching
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-flat">

                <div class="panel-body">
                    <div class="shipment">
                        <div class="dtitlepicker">
                            <span>
                                Shipment
                            </span>
                        </div>
                        <div class="dselectpicker">
                            <select id="shipmentpicker" class="selectpicker" data-live-search="true">
                            </select>
                        </div>
                        <br/>
                        <div id="shipment_kvs" style="margin: 0px 8px"></div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="shipment">
                        <div class="dtitlepicker">
                            <span>
                                Slot
                            </span>
                        </div>
                        <div id="slotxpicker_loading">Loading... please wait...</div>
                        <div class="dselectpicker">
                            <select id="slotxpicker" class="selectpicker" data-live-search="true">
                            </select>
                        </div>
                        <br/>
                        <div id="slot_kvs" style="margin: 0px 8px"></div>
                    </div>
                </div>
                <div>
                    <div class="btn btn-primary" id="add_to_matching" style="margin-left: 16px">
                        Add to Matching List
                    </div>
                </div>
                <br/>
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
            var shipment_saved_data = [];
            var slot_saved_data = [];
            let indexed_city_list = [];

            var current_active_shipment = -1;
            var current_active_slot = -1;

            var setActiveShipment = (s) => {
                current_active_shipment = s;
            }

            var setActiveSlot = (s) => {
                current_active_slot = s;
            }

            $('#loading_modal').hide();

            $('#shipmentpicker').change(function() {
                let shipment_data = findShipmentById(this.value);
                if(shipment_data != null)
                    console.log(shipment_data);
                
                setActiveShipment(shipment_data);
                showKVSShipment(shipment_data);
            });

            $('#slotxpicker').change(function() {
                let slot_data = findSlotById(this.value);
                if(slot_data != null)
                    console.log(slot_data);
                
                setActiveSlot(slot_data);
                showKVSSlot(slot_data);
            });

            $('#add_to_matching').click((e) => {
                e.preventDefault();
                let url = endpoint_url + "match/submit_matching";

                $('#loading_modal').show();

                $.ajax({
                    "url": url,
                    "type": "GET",
                    "data": {
                        "id_shipment": current_active_shipment.id,
                        "id_slot": current_active_slot.id
                    },
                    "beforeSend": function(xhr){
                        xhr.setRequestHeader('Content-Type', 'application/json');
                    },
                    "success": (data) => {
                        $('#loading_modal').hide();
                        alert(data.result);
                        location.reload();
                    }
                });

                // will be implement
                // createMatchedData({
                //     'json_data': JSON.stringify({
                //         1: "a",
                //         "a": 1
                //     }),
                //     "left": $("#shipmentpicker option:selected").text(),
                //     "right": $("#slotxpicker option:selected").text()
                // });
                // var body = $("html, body");
                // body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
                   
                // });
            });

            var isFunction = (f) => {return f && {}.toString.call(f) === '[object Function]';}

            var createIndexedCityList = (callback) => {
                let len = airport_city_list.length;
                for(let i = 0; i < len; i++)
                    indexed_city_list[airport_city_list[i].id] = airport_city_list[i].name;

                console.log(indexed_city_list);
                if(isFunction(callback))
                            callback();
            }

            var findShipmentById = (id) => {
                let len = shipment_saved_data.length;
                for (var i = 0; i < len; i++){
                    if(shipment_saved_data[i].id == id){
                        return shipment_saved_data[i];
                    }
                }

                return null;
            }

            var findSlotById = (id) => {
                let len = slot_saved_data.length;
                for (var i = 0; i < len; i++){
                    if(slot_saved_data[i].id == id){
                        return slot_saved_data[i];
                    }
                }

                return null;
            }

            var findTheCity = (cid) => {
                let city_name = indexed_city_list[cid];
                if(city_name)
                    return city_name;

                return "error: city undefined";
            }

            var getInitAirportCityList = (callback) => {
                let url = endpoint_url + "location/airportcity";
                $.ajax({
                    "url": url,
                    "type": "GET",
                    "beforeSend": function(xhr){
                        xhr.setRequestHeader('Content-Type', 'application/json');
                    },
                    "success": (data) => {
                        airport_city_list = data.result;
                        if(isFunction(callback))
                            callback();
                    }
                });
            }
            
            var getInitShipmentData = (callback) => {
                let url = endpoint_url + "shipment/all";

                var integrate_city_data = (data) => {
                    data.forEach((shipment) => {
                        shipment["city_origin_name"] = findTheCity(shipment.id_origin_city);
                        shipment["city_destination_name"] = findTheCity(shipment.id_destination_city);
                    });
                }

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

            var getSlotByShipmentId = (id_tips_booking, callback) => {
                let url = endpoint_url + "match/find_slot";

                $.ajax({
                    "url": url,
                    "type": "GET",
                    "data": {
                        "id": id_tips_booking
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

            var populateShipmentData = (datas) => {
                $('#shipmentpicker').html("");
                let i = 0;

                resetKVSShipment();
                if(!datas)
                    return;
                datas.forEach((data) => {
                    if(i == 0){
                        setActiveShipment(data);
                        showKVSShipment(data);
                    }
                    $('#shipmentpicker')
                    .append('<option value="' + data.id + '">' + data.shipment_id + ' (' + data.city_origin_name + '->' + data.city_destination_name + ')' + '</option>');
                    i++;
                });

                $('#shipmentpicker').selectpicker('refresh');
                $('#shipmentpicker').selectpicker('render');
            }

            var populateSlotData = (datas) => {
                $('#slotxpicker').html("");
                let i = 0;

                resetKVSSlot();
                if(datas){
                    datas.forEach((data) => {
                        console.log("slotx::: ", data);
                        if(i == 0){
                            setActiveSlot(data);
                            showKVSSlot(data);
                        }
                        $('#slotxpicker')
                        .append('<option value="' + data.id + '">ID: ' + data.slot_id + ', BK:' + data.booking_code + ', DEP:' + data.depature + ' (' + data.origin_city + '->' + data.destination_city + ')' +  '</option>');
                        i++;
                    });
                }
                $('#slotxpicker').selectpicker('refresh');
                $('#slotxpicker').selectpicker('render');
            }


            var resetKVSShipment = () => {
                $('#shipment_kvs').html("");
            }

            var createKVSShipment = (key, value) => {
                $('#shipment_kvs').append('\
                    <div class="row">\
                        <div class="col-md-3">'
                            + key + 
                        '</div>\
                        <div class="col-md-9">'
                            + value + 
                        '</div>\
                    </div>');
            }

            var showKVSShipment = (shipment_data) => {
                showSlotPickerLoading();
                getSlotByShipmentId(shipment_data.id, (slots) => {
                    hideSlotPickerLoading();
                    slot_saved_data = slots;
                    console.log("SLOTTTTT", slots);
                    populateSlotData(slots);
                });
                resetKVSShipment();
                for (var key in shipment_data)
                    if (shipment_data.hasOwnProperty(key))
                        createKVSShipment(key, shipment_data[key]);
            }


            var resetKVSSlot = () => {
                $('#slot_kvs').html("");
            }
            var createKVSSlot = (key, value) => {
                $('#slot_kvs').append('\
                    <div class="row">\
                        <div class="col-md-3">'
                            + key + 
                        '</div>\
                        <div class="col-md-9">'
                            + value + 
                        '</div>\
                    </div>');
            }

            var showKVSSlot = (slot_data) => {
                resetKVSSlot();
                for (var key in slot_data)
                    if (slot_data.hasOwnProperty(key))
                        createKVSSlot(key, slot_data[key]);
            }

            var createMatchedData = (matched_data) => {
                $('#matched_list').append('\
                    <div data-matchedData="' + matched_data.json_data + '" style="margin-bottom: 8px;">\
                        <span class="label label-primary">' + matched_data.left + '</span> <span>matched to</span> <span class="label label-success">' + matched_data.right + '</span> <span class="label label-danger delete-matched">X</span>\
                    </div>');
            }



            var showSlotPickerLoading = () => {
                $('#slot_kvs').hide();
                $('#slotxpicker_loading').show();
            }

            var hideSlotPickerLoading = () => {
                $('#slot_kvs').show();
                $('#slotxpicker_loading').hide();
            }

            getInitAirportCityList(() => {
                createIndexedCityList(() => {
                    getInitShipmentData((shipments) => {
                        populateShipmentData(shipments);
                        shipment_saved_data = shipments;
                    });
                });
            });
        });
    </script>
@endsection
