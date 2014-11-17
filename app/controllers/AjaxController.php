<?php

class AjaxController extends BaseController {


	public function getAjax()
	{
		return View::make('ajax.index');
	}

    public function getChat(){
        return View::make('chat');
    }

    public function addCart()
    {
        header('Content-type: text/javascript');
        if(isset($_POST['id_prod'])){
            $pro = Product::where('id','=',$_POST['id_prod'])->first();

            $item = array();
            if($pro->count())
            {
               $item =  Session::push('cart.item', $pro);
               return Response::json($item);
            }

        }
    }

    public function postChat()
    {
        $function = $_POST['function'];
    
    $log = array();
    
    switch($function) {
    
         case('getState'):
             if(file_exists('chat.txt')){
               $lines = file('chat.txt');
             }
             $log['state'] = count($lines); 
             break; 
        
         case('update'):
            $state = $_POST['state'];
            if(file_exists('chat.txt')){
               $lines = file('chat.txt');
             }
             $count =  count($lines);
             if($state == $count){
                 $log['state'] = $state;
                 $log['text'] = false;
                 
                 }
                 else{
                     $text= array();
                     $log['state'] = $state + count($lines) - $state;
                     foreach ($lines as $line_num => $line)
                       {
                           if($line_num >= $state){
                         $text[] =  $line = str_replace("\n", "", $line);
                           }
         
                        }
                     $log['text'] = $text; 
                 }
              
             break;
         
         case('send'):
          $nickname = htmlentities(strip_tags($_POST['nickname']));
             $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
              $message = htmlentities(strip_tags($_POST['message']));
         if(($message) != "\n"){
            
             if(preg_match($reg_exUrl, $message, $url)) {
                $message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $message);
                } 
             
            
             fwrite(fopen('chat.txt', 'a'), "<span>". $nickname . "</span>" . $message = str_replace("\n", " ", $message) . "\n"); 
         }
             break;
        
    }
    
    echo json_encode($log);
    }

	public function postAjax()
	{
		//check if its our form
        if ( Session::token() !== Input::get( '_token' ) ) {
            return Response::json( array(
                'msg' => 'Unauthorized attempt to create setting'
            ) );
        }
 
        
        //$categoria = 
 
        //.....
        //validate data
        //and then store it in DB
        $categoria = new Category;

        $categoria->name = $_POST['categoria'];

        if($categoria->save()){
        	/*$response = array(
            'status' => 'success',
            'msg' => 'Setting created successfully',
        );*/
		$response = Category::all();
 
        return Response::json( $response );

        }
        //.....
 
        
	}

    public function getFeed()
    {
        $producto = Product::where('availability','=',1)->get();
        return View::make('feed')->with('producto', $producto);
    }

    public function posGetA2()
    {
      header('Content-type: text/javascript');

        $producto = DB::table('products as p')->join('categories as c','p.category_id','=','c.id')
        ->select('p.title',
                'p.description',
                'p.price',
                'p.image',
                'c.name'

            )->where('p.availability','=',1)->get();

        $totalPro = count($producto);

       
        return Response::json($producto);
    }

    public function posGetA()
    {
        header('Content-type: text/javascript');

        $producto = DB::table('products as p')->join('categories as c','p.category_id','=','c.id')
        ->select('p.title',
                'p.description',
                'p.price',
                'p.image',
                'c.name'

            )->where('p.availability','=',1)->get();

        $totalPro = count($producto);

       
        return Response::json($producto);
    }
}