<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\material;
class materialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $material = \DB::table('materials')->Paginate(7);
            return response()->json(['status' => 'success','code'=>'200', 'data' => Material::all()]);    
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
        $this->validate($request, [
            'thumbnail' => 'required',
            'title' => 'required',
            'content' => 'required'
          ]);
   
          if (Material::create($request->all())) {
            return response()->json(['status' => 'success','code'=>'201','data' => $request->all()]);   
            // return response()->json(['status' => 'success' ,'code' => '201', 'message' => 'Data has been created'],201);
          } else {
            return response()->json(['status' => 'error','code' => '500', 'message' => 'Internal Server Error' ],500);
          }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material = Material::find($id);
        if ($material) {
          return response()->json(['status' => 'success','code' => '200', 'data'=> $material]);
        }
 
        return response()->json(['status' => 'error','code' => '404', 'message' => 'Data not found'],404);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'thumbnail' => 'required',
            'title' => 'required',
            'content' => 'required'
          ]);
   
          $material = Material::find($id);
          if ($material) {
            $material->update($request->all());
            return response()->json(['status' => 'success','code'=>'200', 'message' => 'Data has been updated']);
          }
   
          return response()->json(['status' => 'error','code'=>'400', 'message' => 'Cannot updating data'],400);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $material = Material::find($id);
        if ($material) {
        $material->delete();
        return response()->json(['stats' => 'success','code'=>'200', 'message' => 'Data has been deleted']);
      }
 
      return response()->json(['status' => 'error','code'=>'400', 'message' => 'Cannot deleting data'],400);
    }
    public function register(Request $request) {
            $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json(['status' => true,'code'=>'200','data' => $user,"token" => $token]);             
    }
}