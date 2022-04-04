<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\user_has_document;
use App\Models\rider_category;
use App\Models\rider_has_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AllRidersController extends Controller
{
    public function __construct()
    {
        $this->storePath = public_path('\upload\Document\\');
        $this->middleware('auth');
        $this->user = Auth::user();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $members = User :: where('user_group','=','4')->where('status','=','Request Approved')->get();
        $riderCategoryList = rider_category :: all();

        return view('all-riders.index',compact('user','members','riderCategoryList'));
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $members = User :: find($id);
        $riderCategoryList = rider_category :: all();

        return view('all-riders.show',compact('user','members','riderCategoryList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $members = User :: with('getUserCategory.getcategoryName')->find($id);
        $riderCategoryList = rider_category :: all();
        // dd($members);

        return view('all-riders.edit',compact('user','members','riderCategoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user = Auth::user();
        $members = User :: find($id);
        $input = $request->all();

        //user_has_category
        $inputUserHasCategory['user_id'] = $id;
        $inputUserHasCategory['category_id'] = $input['user_category'];
        $inputUserHasCategory['updated_by'] = $user->id;

        //findPrev
        $deletePrevCategory = rider_has_category::where('user_id',$id)->delete();

        //create
        $create = rider_has_category::create($inputUserHasCategory);

        $members->update($input);

        return redirect('all-riders')->with('success', 'Approved Rider Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $input = $request->all();
        $members = User :: find($id);
        $input['is_deleted'] = '1';
        $members->update($input);

        return redirect()->back()->with('success', 'Approved Rider Deleted Successfully');
    }

    public function document($id)
    {
        $user = Auth::user();
        $members = User :: with('getDocument')->find($id);
        $riderDocument = user_has_document :: where('user_id','=',$id);
        $itemId = $id;
        // dd($members->getDocument);

        return view('all-riders.document',compact('user','members','riderDocument','itemId'));
    }

    public function addDocument($id)
    {
        $url = 'all-riders/document/storedocument';
        $user = Auth::user();
        $members = User :: find($id);
        $itemId = $id;

        return view('all-riders.addDocument',compact('url','user','members','itemId'));
    }
    
    public function storeDocument(Request $request,$id)
    {
        $user = Auth::user();
        $input = $request->all();
        // dd($id);
        $input['user_id'] = $id;
        $input['created_by'] = $user->id;
        // $menu = menu::create($input);
        
        if (array_key_exists('document', $input))
        {
            $file = $input['document'];
            $timenow = Carbon::now();
            $hashname = md5($file->getClientOriginalName().$timenow.rand());

            $store = new user_has_document;

            $store->user_id = $id;
            $store->description = $input['description'];
            $store->category = 'This is Document';
            $store->filename = $file->getClientOriginalName();
            $store->hash = $hashname;
            $store->extension = $file->getClientOriginalExtension();
            $store->mimetype = $file->getMimeType();
            $store->size = $file->getSize();
            $store->upload_by = Auth::user()->id;
            
            $store->path = $file->move($this->storePath.$id.'/', $hashname.'.'.$file->getClientOriginalExtension())
            ->getPathname();
            $store->save();

            return redirect()->back()->with('success', 'File uploaded');

        } 

        return redirect()->back()->with('success', 'Rider Document Upload Successfully');
    }

    public function downloadDocument(Request $request)
    {
        $input = $request->all();
        $findDocument = user_has_document::where('id',$input['documet_id'])->first();

        if($input['download'] == 'rider_document' ){
            $nameFolder = $input['user_id'];
            $fileName = $nameFolder.'\\'.$findDocument->hash.'.'.$findDocument->extension;
            $downloadFile = public_path('upload\Document\\'.$fileName);
            if (!file_exists($downloadFile) || $fileName == NULL) {
                return redirect()->back()->with('warning', 'The File does not exist'); 
            }
            return response()->download(public_path('upload\Document\\'.$fileName));
 
        }
        else{
            dd("donot supoase to be here");
        }
    }

    public function deleteDocument(Request $request)
    {
        $input = $request->all();
        $findDocument = user_has_document::find($input['documet_id']);
        $input['is_deleted'] = '1';
        $findDocument->update($input);

        return redirect()->back()->with('success', 'Successfully Deleted!');
    }
}
