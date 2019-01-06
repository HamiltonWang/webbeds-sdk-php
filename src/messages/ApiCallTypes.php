<?php
/**
 * User: Hamilton
 * Date: 12/11/2018
 * Time: 05:33 PM
 */
namespace webbeds\hotel_api_sdk\messages;
/**
 * Interface ApiCallTypes
 * @package webbeds\hotel_api_sdk\messages
 */
interface ApiCallTypes
{
    const SEARCH = "Search";
    const SEARCH_TRANSFER = "SearchTransfers";
    const GET_TRANSFER_TYPES = "GetTransferTypes";
    const GET_DESTINATION = "GetDestinations";
    const GET_LANGUAGES = "GetLanguages";
    const GET_FEATURES = "GetFeatures";
    const GET_HOTEL_NOTE_TYPES = "GetHotelNoteTypes";
    const GET_STATIC_HOTELS_AND_ROOMS = "GetStaticHotelsAndRooms";
    const GET_RESORTS = "GetResorts";
    const GET_MEALS = "GetMeals";
    const GET_ROOM_TYPES = "GetRoomTypes";
    const GET_ROOM_NOTE_TYPES = "GetRoomNoteTypes";
    const GET_THEMES = "GetThemes";
    
    
    
    
}