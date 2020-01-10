<?

namespace custom_mvc\Utils;
use custom_mvc\Exceptions\NotFoundException;

class DependencyInjector{

  private $dependencies = [];

  public function set(string $name, object $value){
    $this->dependencies[$name] = $value;
  }

  public function get(string $name){
    if(!isset($this->dependencies[$name])){
      die("Dependency not found: $name ");
    }
    return $this->dependencies[$name];
  }

}