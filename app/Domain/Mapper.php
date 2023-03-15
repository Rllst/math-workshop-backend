<?php

namespace App\Domain;
use App\Models\ArchiveFolder;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Event;
use App\Models\GalleryFolder;
use App\Models\Post;
use App\Models\Quote;
use App\Models\TeamMember;
use App\Models\User;

class Mapper{
    public static function JsonToCategory($json){
        $rawCategory = json_decode($json,true);
        return new Category($rawCategory);
    }
    public static function JsonToPost($json){
        $rawPost = json_decode($json, true);
        $post = new Post($rawPost);

        $categories = array();
        foreach($rawPost['categories'] as $category){
            array_push($categories, $category['id']);
        }
        $post->categories = $categories;

        return $post;
    }
    public static function JsonToGalleryFolder($json){
        $rawFolder = json_decode($json, true);
        return new GalleryFolder($rawFolder);
    }
    public static function JsonToArchiveFolder($json){
        $rawFolder = json_decode($json, true);
        return new ArchiveFolder($rawFolder);
    }
    public static function JsonToComment($json){
        $rawComment = json_decode($json, true);
        return new Comment($rawComment);
    }
    public static function JsonToTeamMember($json){
        $rawTeamMember = json_decode($json, true);
        return new TeamMember($rawTeamMember);
    }
    public static function JsonToQuote($json){
        $rawQuote = json_decode($json, true);
        return new Quote($rawQuote);
    }
    public static function JsonToEvent($json){
        $rawEvent = json_decode($json, true);
        return new Event($rawEvent);
    }
    public static function JsonToUser($json){
        $rawUser = json_decode($json, true);
        return new User($rawUser);
    }
}
