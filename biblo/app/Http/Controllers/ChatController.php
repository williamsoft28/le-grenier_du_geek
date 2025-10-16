public function __construct()
{
    $this->middleware('auth');  // Obligatoire pour forum et chat
}
