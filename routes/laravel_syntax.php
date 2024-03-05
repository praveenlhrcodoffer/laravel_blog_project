<!-- //|> Routing



Route::get('/',function(){

});


Route:view('/path','view_name');
Route::view('/path','view_name', ['data'=>'data']);

Route:redirect('/pathFrom', 'pathTo');

Route::get('/fetchData', [UserController::class, 'fetchData']);
Route::get('/fetchData', [UserController::class, 'fetchData'])->name('name_of_route');


Route::group(['prefix'=>'/auth'],function(){
Route::get('/',[Controller:class,'method']);
});


$vaidator = Validator::make($request->all(),[
])

if($validator->fails()){
return redirect('post/create')->withErrors($validator)->withInput();
} -->
