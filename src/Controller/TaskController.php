<?php 

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
class TaskController extends AbstractController
{
    private  $taskRepository;
    private $flashMessage;
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository=$taskRepository;
       // $this->flashMessage=$flashMessage;
    }


    #[Route("/ajouter",name:"ajouter_task")]
   
    public function add_task(Request $request,EntityManagerInterface $entityManager)
    {
        $task=new Task();
      
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){

            $task=$form->getData();
            //$entityManager=$this->$doctrine->getManager();
            $entityManager->persist($task);
            $entityManager->flush();
         //   $this->flashMessage->add("success","task ajouter");
         
            $this->addFlash("success", "task ajouter");
            return $this->redirectToRoute('list_tasks');
        }
        return $this->render('ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route("/",name:"list_tasks")]
    public function home()
    {
         $sayHallo="hello houda cv";
    //    return $this->render('home.html.twig',[
    //     "hello"=>$sayHallo
    //    ]);
    $tasks=$this->taskRepository->findAll();
    // $tasks=[
    //     [
    //     "id"=>1,
    //     "title"=>"math home work",
    //     "description"=>"math equations to complete"
    //     ],
    //     [
    //         "id"=>2,
    //         "title"=>"science home work",
    //         "description"=>"science task to complete"
    //     ],
    //     [
    //         "id"=>3,
    //         "title"=>"arabic home work",
    //         "description"=>"arabic equations to complete"
    //     ]
    //     ];
        return $this->render('home.html.twig',[
            "tasks"=>$tasks,
            "hello"=>$sayHallo
        ]);
    }
    #[Route("/task_show/{id}",name:"task_show_route")]
    public function showTask($id)
    {
        
        $tasks_by_id=$this->taskRepository->find($id);
        if(!$tasks_by_id){
            
            return $this->render('msgerr.html.twig',[
                "id_task"=>$id
               
             ]);
       // throw new Exception("no task found for this is number'.$id");
       
        }
      
        return $this->render('show.html.twig',[
           "show_task"=>$tasks_by_id
         
        ]);
      
    }

  
   
    #[Route("/edit_task/{id}",name:"update_task")]
   
    public function update_task(Request $request,EntityManagerInterface $entityManager,Task $task)
    {
        
        

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){

            $task=$form->getData();
            //$entityManager=$this->$doctrine->getManager();
            $entityManager->persist($task);
            $entityManager->flush();
          //  $this->flashMessage->add("success","task modifie");
          $this->addFlash("success", "task modifie");
            return $this->redirectToRoute('list_tasks');
        }
        return $this->render('update.html.twig', [
            'form' => $form->createView(),
        ]);
    }
   
    
    #[Route("/supprimer_task/{id}",name:"delete_task")]
   
    public function delete_task(EntityManagerInterface $entityManager,Task $task)
    {
        
       
        
            //$entityManager=$this->$doctrine->getManager();
            $entityManager->remove($task);
            $entityManager->flush();
          //  $this->flashMessage->add("success","task supprime");
          $this->addFlash("success", "task supprime");
            return $this->redirectToRoute('list_tasks');
        
       
    }

    #[Route("/about/me")]
    public function about():Response
    {
        return new Response(
            'hello i m houda'
        );
    }
}
?>