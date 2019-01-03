<?php
/**
 * Created by PhpStorm.
 * Project: ADONIAS
 * Date: 11/22/2018
 * Time: 11:34 AM
 */

class ProjectController {
    private static $_instance,$current_Project;
    private $database;

    private function __construct() {
        $this->database = Database::getInstance();
    }

    static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new ProjectController();
        }
        return self::$_instance;
    }


    static function  getCurrentProject(){
        return self::$current_Project;
    }

    static function removeCurrentProject(){
        self::$current_Project = NULL;
    }

    static function currentProjectExists(){
        return isset(self::$current_Project) && Session::exists('Project_id');
    }

    function addProject(Project $new_Project){
        return $this->database->insert('Projects',array('name','description','image_path','image_name','client','type','price'),
            array(
                $new_Project->getProjectName(),
                $new_Project->getDescription(),
                $new_Project->getImagePath(),
                $new_Project->getImageName(),
                $new_Project->getClient(),
                $new_Project->getType(),
                $new_Project->getPrice(),
            )
        );
    }


    function getProjectByName($name){
        $result = $this->database->select('Projects',array('*'),"WHERE name = '{$name}' AND enabled = true;");
        if(count($result)==1){
            $found_Project = $result[0];
            $Project = new Project();
            $Project->setId         ($found_Project['id'         ]);
            $Project->setProjectName($found_Project['name'       ]);
            $Project->setDescription($found_Project['description']);
            $Project->setImagePath  ($found_Project['image_path' ]);
            $Project->setType       ($found_Project['type'       ]);
            $Project->setClient     ($found_Project['client'     ]);
            $Project->setPrice      ($found_Project['price'      ]);
            $Project->setCreatedAt  ($found_Project['created_at' ]);
            $Project->setUpdatedAt  ($found_Project['updated_at' ]);
            return $Project;
        }
        return false;
    }

    function getProject($id, $enabled =  "true"): array {
        $where = $enabled ? "WHERE id = '{$id}' AND enabled = 'true' ;" : "WHERE id = '{$id}'";
        $projects = $this->database->select('projects',array('*'),$where);
        if(count($projects)==1){
            return $projects[0];
        }
        return array();
    }

    function getProjects($enabled = "true"){
        $where = $enabled ? "WHERE enabled= true;" : "";
        $projects = $this->database->select('projects',array('*'),$where);
        return count($projects) > 0 ? $projects : false;
    }

    function updateProject($projectId, array $fieldsToUpdate, array $dataToUpdateWith){
        return $this->database->update('Projects',$fieldsToUpdate,$dataToUpdateWith,"WHERE id = '{$projectId}'");
    }
    public function disableProject($id, $enabled){
        return $this->database->update('Projects',array('enabled'),
            array($enabled),"WHERE id = '{$id}'");
    }
    private function ProjectExists($column,$value){
        $result = $this->database->select('Projects',array($column),"WHERE {$column}='{$value}';");
        if($result && count($result)== 1){
            return true;
        }
        return false;
    }

    public function projectFromArray(array $project):Project{

        if(isset($project)){
            if(isset($project["id"])){
                $id = $project["id"];
            }
            if(isset($project["name"])){
                $name = $project["name"];
            }
            if(isset($project["description"])){
                $description = $project["description"];
            }
            if(isset($project["image_path"])){
                $image_path = $project["image_path"];
            }
            if(isset($project["image_name"])){
                $image_name = $project["image_name"];
            }
            if(isset($project["enabled"])){
                $enabled = $project["enabled"];
            }
            if(isset($project["type"])){
                $type = $project["type"];
            }
            if(isset($project["client"])){
                $client = $project["client"];
            }
            if(isset($project["price"])){
                $price = $project["price"];
            }
        }
        $new_project = new Project();
        $new_project->setId($id);
        $new_project->setProjectName($name);
        $new_project->setDescription($description);
        $new_project->setImagePath($image_path);
        $new_project->setImageName($image_name);
        $new_project->setEnabled($enabled);
        $new_project->setType($type);
        $new_project->setPrice($price);
        $new_project->setClient($client);

        return $new_project;
    }
}
