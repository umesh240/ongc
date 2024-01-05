<?php

namespace App\Http\Controllers;

use App\Models\SocialLinks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\Functions;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class SocialLinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socialLinks = [];
        $socialLinks[] = array('sc_name' => 'Facebook', 'sc_icon' => 'fa-facebook');
        $socialLinks[] = array('sc_name' => 'Twitter', 'sc_icon' => 'fa-twitter');
        $socialLinks[] = array('sc_name' => 'Instagram', 'sc_icon' => 'fa-instagram');
        $socialLinks[] = array('sc_name' => 'Linkedin', 'sc_icon' => 'fa-linkedin');
        $socialLinks[] = array('sc_name' => 'Pinterest', 'sc_icon' => 'fa-pinterest');
        $socialLinks[] = array('sc_name' => 'Youtube', 'sc_icon' => 'fa-youtube');
        $socialLinks[] = array('sc_name' => 'Vimeo', 'sc_icon' => 'fa-vimeo');
        $socialLinks[] = array('sc_name' => 'Telegram', 'sc_icon' => 'fa-telegram');
        $socialLinks[] = array('sc_name' => 'Skype', 'sc_icon' => 'fa-skype');

        foreach ($socialLinks as $key => $val) {
            $sc_name = $val['sc_name'];
            $sc_icon = $val['sc_icon'];
            $checkQuery = DB::table('social_links')->where('sc_name', $sc_name)->exists();
            if(!$checkQuery){
                $rowData = [];
                $rowData['sc_name']     = $sc_name;
                $rowData['sc_icon']     = $sc_icon;
                $rowData['created_at']  = date('Y-m-d H:i:s');
                $runQuery = DB::table('social_links')->insert($rowData);
            }
        }
        $social_links = DB::table('social_links')->orderBy('sc_show', 'desc')->orderBy('sc_link', 'desc')->get();
        $data['social_links'] = $social_links;
        return view('socials', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SocialLinks  $socialLinks
     * @return \Illuminate\Http\Response
     */
    public function show(SocialLinks $socialLinks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SocialLinks  $socialLinks
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialLinks $socialLinks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocialLinks  $socialLinks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request->all());
        $link_cdsAll = $request->link_cdsAll;
        $link_cdsAll = explode(',', $link_cdsAll);
        foreach ($link_cdsAll as $key => $code) {
            $var = 'sid_'.$code;
            $sid = $request->$var;
            $var = 'links_'.$code;
            $links = $request->$var;
            $var = 'show_'.$code;
            $show = $request->$var;
            if($show != 1 || $show == 'undefined' || $show == null || $links == null){
                $show = 0;
            }
            // echo $sid."|<>|".$links."|<>|".$show."|<br>";

            $rowData = [];
            $rowData['sc_link']     = strtolower($links);
            $rowData['sc_show']     = $show;
            $rowData['updated_at']  = date('Y-m-d H:i:s');
            $runQuery = DB::table('social_links')->where('soc_id', $sid)->update($rowData);
        }
        return redirect()->back()->with('success', 'Social links updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocialLinks  $socialLinks
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialLinks $socialLinks)
    {
        //
    }
}
