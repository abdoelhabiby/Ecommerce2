<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Vendor;
use Illuminate\Http\Request;
use App\Models\Admin\MainCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Notifications\VendorCreated;
use Illuminate\Support\Facades\Notification;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::with("mainCategory")->selection()->descending()->paginate(PAGINATE_COUNT);
        return view("admin.vendors.index",compact("vendors"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $main_categories = MainCategory::dataCurrentLanguage()->active()->select("id","name")->get();
        return view("admin.vendors.create",compact("main_categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorRequest $request)
    {



         $validated = $request->validated();


         try {

            $path = null;

            if ($request->has("logo")) {
                $path = imageUpload($request->logo, "vendors");
            }

            $validated['logo'] = $path;
            $vendor =  Vendor::create($validated);
            $vendor->notify(new VendorCreated($vendor));
            return redirect(route("admin.vendors.index"))->with(['success' => __("admin.success create")]);


        } catch (\Exception $ex) {
            return redirect(route("admin.vendors.index"))->with(['error' => __("admin.message error")]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  /*   public function show($id)
    {
        //
    } */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        $main_categories = MainCategory::dataCurrentLanguage()->active()->select("id", "name")->get();
        return view("admin.vendors.edit",compact("vendor", "main_categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendorRequest $request, Vendor $vendor)
    {


       try {


            $validated = collect($request->validated());

            $path = null;
            if($request->has("logo")){
                $path = imageUpload($request->logo,"vendors");
                $validated['logo'] = $path;
                $photo_to_delet = $vendor->logo ?? null;

                deleteFile($photo_to_delet);
            }

            $filterd =  $validated->filter(function($value,$key){
                return $value != null;
            });

            $filterd_array = json_decode($filterd,true);
            $vendor->update($filterd_array);

            return redirect(route("admin.vendors.index"))->with(['success' => __("admin.success create")]);

        } catch (\Exception $ex) {
            return redirect(route("admin.vendors.index"))->with(['error' => __("admin.message error")]);

        }



    }



    public function changeActive(Vendor $vendor)
    {

        try {

        $status  = $vendor->active == 1 ? 0: 1 ;

        $vendor->update(['active' => $status]);
            return redirect(route("admin.vendors.index"))->with(['success' => __("admin.success create")]);


         } catch (\Exception $ex) {
            return redirect(route("admin.vendors.index"))->with(['error' => __("admin.message error")]);

        }
    }

    /**
     * Remove the specified resource from storage.
     * //===========note =================
     * now vendors not added products in the futur must check if the
     * vendor has products befoure delete
     * //======== end note ============
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {

        try {

            $vendor->delete();
            deleteFile($vendor->logo);

            return redirect(route("admin.vendors.index"))->with(['success' => __("admin.success delete")]);


        } catch (\Exception $ex) {
            return redirect(route("admin.vendors.index"))->with(['error' => __("admin.message error")]);
        }

    }
}
