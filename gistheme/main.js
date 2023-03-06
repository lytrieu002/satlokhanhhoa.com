const siteUrl = "https://satlokhanhhoa.com";
proj4.defs(
   "EPSG:9217",
   "+proj=tmerc +lat_0=0 +lon_0=108.25 +k=0.9999 +x_0=500000 +y_0=0 +ellps=WGS84 +towgs84=-191.90441429,-39.30318279,-111.45032835,-0.00928836,0.01975479,-0.00427372,0.252906278 +units=m +no_defs +type=crs"
);
ol.proj.proj4.register(proj4);
var proj = new ol.proj.Projection({
   code: "EPSG:3857",
   units: "m",
   //global: false,
});
let bounds = [11975202.080540122, 1288434.9336329445, 12307556.122337615, 1479986.6133433913];
bounds = new ol.extent.buffer(bounds, 10000);
const center = new ol.proj.transform([588664.9124, 1364566.478], "EPSG:9217", "EPSG:3857");
//map.getView().fit(new ol.extent.buffer(extent_phong, 0.0005) , { duration:800 });
var view = new ol.View({
   projection: proj,
   extent: [11975202.080540122, 1288434.9336329445, 12307556.122337615, 1479986.6133433913],
   center: center,
   zoom: 9.5,
});
function el(id) {
   return document.getElementById(id);
}
//Basemap: OpenStreet Map
var osmBaseMap = new ol.layer.Tile({
   title: "OpenStreet Map",
   baseLayer: true,
   visible: false,
   source: new ol.source.OSM(),
});
//Basemap: Google Sattelite Map
var googleBaseMap = new ol.layer.Tile({
   title: "Google Sattelite",
   baseLayer: true,
   visible: true,
   opacity: 1.0,
   source: new ol.source.XYZ({
      url: "https://mt0.google.com/vt/lyrs=y&hl=en&x={x}&y={y}&z={z}&s=Ga",
      crossOrigin: "anonymous",
   }),
});
var noBaseMap = new ol.layer.Tile({
   title: "No Basemap",
   baseLayer: true,
   visible: false,
});
///////////////////////////////////////////////////////////
//Basemap Group
var baseLayers = new ol.layer.Group({
   title: "Bản đồ nền",
   openInLayerSwitcher: true,
   layers: [osmBaseMap, googleBaseMap],
});

var layer_CapDoRuiRo = new ol.layer.Tile({
   title: "Bản đồ cấp độ rủi ro",
   visible: true,
   displayInLayerSwitcher: true,
   source: new ol.source.TileWMS({
      url: "https://satlokhanhhoa.com/geoserver/WebGIS_NhaTrang/wms",
      //layer: "WebGIS_NhaTrang:calculatedMap",
      params: {
         FORMAT: "image/png",
         VERSION: "1.1.1",
         tiled: true,
         STYLES: "WebGIS_NhaTrang:style_SatLo",
         LAYERS: "WebGIS_NhaTrang:calculatedMap",
         exceptions: "application/vnd.ogc.se_inimage",
         //FORMAT_OPTIONS: "antialias:none",
         //tilesOrigin: 545198.8585090899 + "," + 1305590.739236221,
      },
   }),
});

var layer_ranhGioiTinh = new ol.layer.Tile({
   title: "Ranh giới tỉnh",
   visible: true,
   displayInLayerSwitcher: true,
   source: new ol.source.TileWMS({
      url: "https://satlokhanhhoa.com/geoserver/WebGIS_NhaTrang/wms",
      projection: new ol.proj.Projection({
         code: "EPSG:4326",
         units: "degrees",
         axisOrientation: "neu",
         //global: true
      }),
      //layer: "WebGIS_NhaTrang:calculatedMap",
      params: {
         FORMAT: "image/png",
         VERSION: "1.1.1",
         tiled: true,
         STYLES: "WebGIS_NhaTrang:style_hanhChinhTinh",
         LAYERS: "WebGIS_NhaTrang:hanhChinhTinh",
         exceptions: "application/vnd.ogc.se_inimage",
         //FORMAT_OPTIONS: "antialias:none",
         //tilesOrigin: 545198.8585090899 + "," + 1305590.739236221,
      },
   }),
});
var layerGroup_hanhChinh = new ol.layer.Group({
   title: "Hành chính",
   openInLayerSwitcher: true,
   layers: [layer_ranhGioiTinh],
});
///////////////////////////////////////////////////////////
//Basemap switcher
var layerSwitcher = new ol.control.LayerSwitcher({
   tipLabel: "Bật tắt lớp bản đồ",

   show_progress: false,
   reordering: false,
   extent: true,
});
var mousePositionControl = new ol.control.MousePosition({
   className: "custom-mouse-position",
   // projection: new ol.proj.Projection({
   //    code: "EPSG:9217",
   //    units: "m",
   // }),
   //placeholder: "Move mouse inside the map",
   target: document.getElementById("location1"),
   coordinateFormat: ol.coordinate.createStringXY(5),
   undefinedHTML: "&nbsp;",
});
function setBasemap(mapType) {
   switch (mapType) {
      case "GoogleSattelite":
         googleBaseMap.setVisible(true);
         el("GoogleSattelite").checked = true;
         el("OpenStreetMap").checked = false;
         el("noBaseMap").checked = false;
         osmBaseMap.setVisible(false);
         break;
      case "OpenStreetMap":
         el("GoogleSattelite").checked = false;
         el("OpenStreetMap").checked = true;
         el("noBaseMap").checked = false;
         googleBaseMap.setVisible(false);
         osmBaseMap.setVisible(true);
         break;
      default: //>3
         el("GoogleSattelite").checked = false;
         el("OpenStreetMap").checked = false;
         el("noBaseMap").checked = true;
         googleBaseMap.setVisible(false);
         osmBaseMap.setVisible(false);
   }
}
function setLayerVisible(layerName) {
   switch (layerName) {
      case "chkRanhGioiXa":
         console.log("xa");
         layer_ranhGioiXa.setVisible(el(layerName).checked);
         break;
      case "chkRanhGioiHuyen":
         console.log("huyen");
         layer_ranhGioiHuyen.setVisible(el(layerName).checked);
         break;
      case "chkBanDoNgap":
         console.log("ngap");
         layerGroup_mucNgap.setVisible(el(layerName).checked);
         break;
      case "chkSongSuoi":
         console.log("song");
         layerGroup_songSuoi.setVisible(el(layerName).checked);
         break;
      case "chkDuongBo":
         console.log("duong");
         layer_matDuongBo.setVisible(el(layerName).checked);
         break;
      default: //>3
         console.log("default");
   }
}
var slideIndex = 1;
function plusSlides(n) {
   showSlides((slideIndex += n));
}
function currentSlide(n) {
   showSlides((slideIndex = n));
}
function showSlides(n) {
   var i;
   var slides = document.getElementsByClassName("mySlides");
   //console.log("slides.length: " + slides.length)
   if (n > slides.length / 2) {
      slideIndex = 1;
   }
   if (n < 1) {
      slideIndex = slides.length / 2;
   }
   for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
   }

   slides[slideIndex - 1].style.display = "block";
   //console.log("slides index: " + slideIndex)
   //console.log("slides.length / 2 + slideIndex - 1 : " + (slides.length / 2 + slideIndex - 1));
   slides[slides.length / 2 + slideIndex - 1].style.display = "block";
}
function checkForm() {
   document.getElementById("submit_calculate").disabled = !document.getElementById("sure").checked;
}
///////////////////////STYLES///////////////////////////////

//Main map
var map = new ol.Map({
   target: "map",
   interactions: ol.interaction.defaults({
      altShiftDragRotate: false,
      pinchRotate: false,
   }),
   layers: [baseLayers, layerGroup_hanhChinh, layer_CapDoRuiRo],
   controls: ol.control.defaults().extend([new ol.control.ZoomSlider(), mousePositionControl, layerSwitcher]),
   view: view,
});
map.getView().fit(bounds, map.getSize());
map.getView().setZoom(9.5);

var geoloc = new ol.control.GeolocationButton({
   title: "Vị trí của bạn",
   zoom: 20,
   followTrack: false,
   delay: 86400000, // delay before removing the location in ms, delfaut 3000
});
map.addControl(geoloc);

// Show position popup
var youAreHere = new ol.Overlay.Popup({
   positioning: "auto",
   anim: true, //Animate the popup the popup
   closeBox: false, //popup has a close box
});
//Add You are here popup on the map
map.addOverlay(youAreHere);

var geolocation = new ol.Geolocation({
   // enableHighAccuracy must be set to true to have the heading value.
   trackingOptions: {
      enableHighAccuracy: true,
   },
   projection: view.getProjection(),
});

const copyright = new ol.Overlay({
   element: document.getElementById("copyright"),
});
map.addOverlay(copyright);

let isFollowing = false;
let count = 0;
let hasWarning = false;
function getUserLocation() {
   console.log("Getting location...");
   isFollowing = true;
   count = 0;
   if (!hasWarning) {
      alert("Vui lòng cho phép truy cập vị trí khi được hỏi để xác định vị trí của bạn!");
      hasWarning = true;
   }
   getPermission();
   setTimeout(getUserPosition, 3000);
}
function getUserPosition() {
   try {
      let lc = geolocation.getPosition();
      if (lc) {
         el("longitude").value = lc[0].toString();
         el("latitude").value = lc[1].toString();
      } else {
         //alert('Cần bật vị trí và cho phép truy cập vị trí khi sử dụng tính năng này!');

         el("toaDo").value = "ERROR_USER_DENIED";
      }
   } catch (e) {
      console.log("khong the lay vi tri 2");
   } finally {
   }
}
function getPermission() {
   try {
      geolocation.setTracking(true);
   } catch (e) {
      console.log("Da tu choi");
   } finally {
   }
}
var geolocation = new ol.Geolocation({
   trackingOptions: {
      enableHighAccuracy: true,
   },
   projection: view.getProjection(),
});
geolocation.on("change:position", () => {
   console.log("In onchange, location: " + geolocation.getPosition());
   console.log("isFollowing: " + isFollowing);
   console.log("Count: " + count);
   if (isFollowing && count < 5) {
      count += 1;
      getUserPosition();
   } else {
      isFollowing = false;
   }
});

// POPUP
var container = document.getElementById("popupX");
var content = document.getElementById("popup-contentX");
var btnRouting = document.createElement("button");
btnRouting.classList = "ol-zoombt";
btnRouting.textContent = "Tìm đường";
var btnZoom = document.createElement("button");
btnZoom.classList = "ol-zoombt";
btnZoom.textContent = "Phóng to";
btnZoom.addEventListener("click", function zoomToFeature(e) {
   var ex = btnZoom.getAttribute("extent");
   var ex0 = Number(ex.split(",")[0]);
   var ex1 = Number(ex.split(",")[1]);
   var ex2 = Number(ex.split(",")[2]);
   var ex3 = Number(ex.split(",")[3]);

   var boun = [ex0, ex1, ex2, ex3];
   boun = new ol.extent.buffer(boun, 1000);

   //var ext = new ol.extent.boundingExtent([ex.split(",")[0], ex.split(",")[1]], [ex.split(",")[2], ex.split(",")[3]]);
   //console.log("ext = " + [ex.split(",")[0], ex.split(",")[1]]);

   //console.log("ext = " + ext);
   //ext[1] = ext[1] - 0.00155;
   //var newext = ol.proj.transformExtent(ext, "EPSG:9217", "EPSG:3857");

   map.getView().fit(boun, { duration: 1000 });
});
content.append(btnZoom);
content.append(btnRouting);
var closer = document.getElementById("popup-closerX");
/**
 * Create an overlay to anchor the popup to the map.
 */
var overlayPopup = new ol.Overlay(
   /** @type {olx.OverlayOptions} */ ({
      element: container,
      autoPan: true,
      autoPanAnimation: {
         duration: 250,
      },
   })
);
map.addOverlay(overlayPopup);
function closePopup() {
   vectorLayerPopup.setSource();
   overlayPopup.setPosition(undefined);
   closer.blur();
   return false;
}
closer.onclick = function () {
   closePopup();
};

var highlightLabelStyles = {
   MultiPolygon: new ol.style.Style({
      stroke: new ol.style.Stroke({
         // color: 'rgb(98, 225, 225)',
         color: "cyan",
         width: 2,
      }),
      // fill: new ol.style.Stroke({
      //     color: 'cyan',
      // })
   }),
};
var stylePopupFunction = function (feature) {
   return highlightLabelStyles[feature.getGeometry().getType()];
};
var projection = new ol.proj.Projection({
   //code: 'EPSG:4326',
   code: "EPSG:3857",
   // units: 'degrees',
   units: "m",
   axisOrientation: "neu",
});
var vectorLayerPopup = new ol.layer.Vector({
   projection: projection,
   title: "Selected feature",
   displayInLayerSwitcher: false,
   style: stylePopupFunction,
});
map.addLayer(vectorLayerPopup);
var hanhChinhMapSource = layer_CapDoRuiRo.getSource();
jQuery(document).ready(function ($) {
   (async () => {
      map.on("singleclick", function (evt) {
         showLabelInfo(evt.coordinate, view, vectorLayerPopup, overlayPopup, hanhChinhMapSource);
      });

      function showLabelInfo(coord, view, vectorLayerPopup, overlayPopup, source) {
         var url = source.getFeatureInfoUrl(coord, view.getResolution() / 20, view.getProjection(), {
            INFO_FORMAT: "application/json",
            FEATURE_COUNT: 1,
         });
         if (url) {
            $.ajax({
               type: "GET",
               url: url,
               dataType: "json",
               success: function (data, status) {
                  try {
                     if (data.features[0] === undefined) {
                        closePopup();
                     }
                     var feature = data.features[0];
                     var featureAttr = feature.properties;
                     var featureName = "BẢN ĐỒ CẤP ĐỘ RỦI RO";
                     $("#popup-nameX").text(featureName);
                     var attributeList = [
                        { name: "Kinh Độ", value: featureAttr["KINHDO"] },
                        { name: "Vĩ độ", value: featureAttr["VIDO"] },
                        { name: "Cấp độ rủi ro", value: featureAttr["CAPDORR"] },
                        { name: "Lượng mưa 5 ngày", value: featureAttr["X5NGAY"] },
                        { name: "Lượng mưa 1 ngày", value: featureAttr["X1NGAY"] },
                        { name: "Lượng mưa 6 giờ", value: featureAttr["X6GIO"] },
                        { name: "Lượng mưa 1 giờ", value: featureAttr["X1GIO"] },
                        { name: "Chỉ số mưa", value: featureAttr["CSMUA"] },
                        { name: "Chỉ số độ dốc", value: featureAttr["CSDOC"] },
                        { name: "Chỉ số rủi ro", value: featureAttr["CSRR"] },
                     ];

                     var attribute_table = $("#attribute_table");
                     attribute_table.html("");

                     attributeList.forEach(function (ele) {
                        var attribute = document.createElement("tr");

                        var attributeName = document.createElement("td");
                        attributeName.classList = "attributes-nameX";
                        attributeName.innerText = ele["name"];

                        var attributeValue = document.createElement("td");
                        attributeValue.classList = "attributes-valueX";
                        attributeValue.innerText = ele["value"];

                        attribute.appendChild(attributeName);
                        attribute.appendChild(attributeValue);

                        $("#attribute_table").append(attribute);
                     });

                     overlayPopup.setPosition(coord);
                     var ft = new ol.format.GeoJSON().readFeatures(data);
                     var vectorSource = new ol.source.Vector({
                        title: "Selected feature",
                        displayInLayerSwitcher: false,
                        features: ft,
                     });
                     btnZoom.setAttribute("extent", ft[0].getGeometry().getExtent());
                     vectorLayerPopup.setSource(vectorSource);
                  } catch (err) {}
               },
            });
         }
      }
   })();
});
