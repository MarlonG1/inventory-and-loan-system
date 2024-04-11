var simplemaps_countrymap_mapdata={
  main_settings: {
   //General settings
    width: "responsive", //'700' or 'responsive'
    background_color: "#FFFFFF",
    background_transparent: "yes",
    border_color: "#ffffff",
    
    //State defaults
    state_description: "State description",
    state_color: "#88A4BC",
    state_hover_color: "#3B729F",
    state_url: "",
    border_size: 1.5,
    all_states_inactive: "no",
    all_states_zoomable: "yes",
    
    //Location defaults
    location_description: "Location description",
    location_url: "",
    location_color: "#FF0067",
    location_opacity: 0.8,
    location_hover_opacity: 1,
    location_size: 25,
    location_type: "square",
    location_image_source: "frog.png",
    location_border_color: "#FFFFFF",
    location_border: 2,
    location_hover_border: 2.5,
    all_locations_inactive: "no",
    all_locations_hidden: "no",
    
    //Label defaults
    label_color: "#ffffff",
    label_hover_color: "#ffffff",
    label_size: 16,
    label_font: "Arial",
    label_display: "auto",
    label_scale: "yes",
    hide_labels: "no",
    hide_eastern_labels: "no",
   
    //Zoom settings
    zoom: "yes",
    manual_zoom: "yes",
    back_image: "no",
    initial_back: "no",
    initial_zoom: "-1",
    initial_zoom_solo: "no",
    region_opacity: 1,
    region_hover_opacity: 0.6,
    zoom_out_incrementally: "yes",
    zoom_percentage: 0.99,
    zoom_time: 0.5,
    
    //Popup settings
    popup_color: "white",
    popup_opacity: 0.9,
    popup_shadow: 1,
    popup_corners: 5,
    popup_font: "12px/1.5 Verdana, Arial, Helvetica, sans-serif",
    popup_nocss: "no",
    
    //Advanced settings
    div: "map",
    auto_load: "yes",
    url_new_tab: "no",
    images_directory: "default",
    fade_time: 0.1,
    link_text: "View Website",
    popups: "detect",
    state_image_url: "",
    state_image_position: "",
    location_image_url: ""
  },
  state_specific: {
    SVAH: {
      name: "Ahuachapán",
      color: "#9a2323",
      hover_color: "#700e0e",
      description: "Población: 375,796"
    },
    SVCA: {
      name: "Cabañas",
      color: "#9a2323",
      hover_color: "#700e0e",
      description: "Población: 174,094"
    },
    SVCH: {
      name: "Chalatenango",
      color: "#9a2323",
      hover_color: "#700e0e",
      description: "Población: 210,845"
    },
    SVCU: {
      name: "Cuscatlán",
      color: "#9a2323",
      hover_color: "#700e0e",
      description: "Población: 276,004"
    },
    SVLI: {
      name: "La Libertad",
      color: "#9a2323",
      hover_color: "#700e0e",
      description: "Población: 830,976"
    },
    SVMO: {
      name: "Morazán",
      color: "#9a2323",
      hover_color: "#700e0e",
      description: "Población: 211,201"
    },
    SVPA: {
      name: "La Paz",
      color: "#9a2323",
      hover_color: "#700e0e",
      description: "Población: 375,457"
    },
    SVSA: {
      name: "Santa Ana",
      color: "#9a2323",
      hover_color: "#700e0e",
      description: "Población: 602,636"
    },
    SVSM: {
      name: "San Miguel",
      color: "#9a2323",
      hover_color: "#700e0e",
      description: "Población: 516,241"
    },
    SVSO: {
      name: "Sonsonate",
      color: "#9a2323",
      hover_color: "#700e0e",
      description: "Población: 520,778"
    },
    SVSS: {
      name: "San Salvador",
      color: "#9a2323",
      hover_color: "#700e0e",
      description: "Población: 1,817,579"
    },
    SVSV: {
      name: "San Vicente",
      color: "#9a2323",
      hover_color: "#700e0e",
      description: "Población: 190,093"
    },
    SVUN: {
      name: "La Unión",
      color: "#9a2323",
      hover_color: "#700e0e",
      description: "Población: 277,731"
    },
    SVUS: {
      name: "Usulután",
      color: "#9a2323",
      hover_color: "#700e0e",
      description: "Población: 386,322"
    }
  },
  locations: {},
  labels: {
    SVAH: {
      name: "Ahuachapán",
      parent_id: "SVAH"
    },
    SVCA: {
      name: "Cabañas",
      parent_id: "SVCA"
    },
    SVCH: {
      name: "Chalatenango",
      parent_id: "SVCH"
    },
    SVCU: {
      name: "Cuscatlán",
      parent_id: "SVCU"
    },
    SVLI: {
      name: "La Libertad",
      parent_id: "SVLI"
    },
    SVMO: {
      name: "Morazán",
      parent_id: "SVMO"
    },
    SVPA: {
      name: "La Paz",
      parent_id: "SVPA"
    },
    SVSA: {
      name: "Santa Ana",
      parent_id: "SVSA"
    },
    SVSM: {
      name: "San Miguel",
      parent_id: "SVSM"
    },
    SVSO: {
      name: "Sonsonate",
      parent_id: "SVSO"
    },
    SVSS: {
      name: "San Salvador",
      parent_id: "SVSS"
    },
    SVSV: {
      name: "San Vicente",
      parent_id: "SVSV"
    },
    SVUN: {
      name: "La Unión",
      parent_id: "SVUN"
    },
    SVUS: {
      name: "Usulután",
      parent_id: "SVUS"
    }
  },
  legend: {
    entries: []
  },
  regions: {}
};