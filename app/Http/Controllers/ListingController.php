<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    public function allListing(){
        return view('listings.allListings',[
            'listings'=>Listings::latest()->filter(request(['tag','search']))->simplePaginate(4),
        ]);
    }

    public function listingById(Listings $listing){
        return view('listings.listingById',[
            'listings'=>$listing,
        ]);
    }

    public function createListing(){
        return view('listings.createListing');
    }

    public function addListing(Request $req){

        $formFields = $req->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($req->hasFile('logo')) {
            $formFields['logo'] = $req->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listings::create($formFields);

        return redirect('/')->with('message','Listing created successfully!');
    }

    public function editListing(Listings $listing){
        return view('listings.edit', ['listing' => $listing]);
    }


    public function updateListing(Request $request, Listings $listing) {

        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }

    public function deleteListing(Listings $listing) {

        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }

    public function manageListing(){
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
