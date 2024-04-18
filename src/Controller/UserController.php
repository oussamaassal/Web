<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use App\Form\LoginType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Form\FormError;

use Symfony\Component\HttpFoundation\Session\SessionInterface;


#[Route('/user')]
class UserController extends AbstractController
{

   public function getUserData(SessionInterface $sessionInterface){
    $serializedUser = $sessionInterface->get('user');
    
    $user = unserialize($serializedUser);
    if(!$user){
        return null;
    }
   return $user;
   }
    public function isAuthenticated(SessionInterface $sessionInterface){
      $user= $this->getUserData($sessionInterface);
        return isset($user);

    }

    public function hasPermissionRole(SessionInterface $sessionInterface,$role){
        if(!$this->isAuthenticated($sessionInterface)) {
            return false;
        }
        $user = $this->getUserData($sessionInterface);
       
        return strtoupper($user->getRole())==strtoupper($role);
    }   

    #[Route('/admin', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository,SessionInterface $sessionInterface): Response
    {
        if(!$this->hasPermissionRole($sessionInterface,"admin")){
            return $this->redirectToRoute('app_user_login');
        }
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
            'loggedIn'=>true,
        ]);
    }

    #[Route('/admin/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,SessionInterface $sessionInterface): Response

    {   
        if(!$this->hasPermissionRole($sessionInterface,"admin")){
            return $this->redirectToRoute('app_user_login');
        }
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Valider l'e-mail ici avant de persister l'utilisateur
            $email = $user->getEmail();
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Gérer les erreurs de validation de l'e-mail
                // Par exemple, afficher un message d'erreur à l'utilisateur
                $form->get('email')->addError(new FormError('L\'adresse e-mail n\'est pas valide.'));
            } else {
                // Si l'e-mail est valide, persister l'utilisateur
                $user->setMotdepasse(password_hash($user->getMotdepasse(), PASSWORD_BCRYPT, ["cost" => 12]));
                $entityManager->persist($user);
                $entityManager->flush();
    
                return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
            }
        }
    
        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
            'loggedIn'=>true,

        ]);
    }
    #[Route('/admin/search', name: 'app_user_search', methods: ['GET'])]
    public function search(Request $request, UserRepository $userRepository,SessionInterface $sessionInterface): Response
    {
        if(!$this->hasPermissionRole($sessionInterface,"admin")){
            return $this->redirectToRoute('app_user_login');
        }
        $searchTerm = trim($request->query->get('search'));
        $results = [];
    
        if (empty($searchTerm)) {
            $results = $userRepository->findAll();
        } else {
            $results = $userRepository->searchByEmail($searchTerm);
        }
        
        return $this->render('user/index.html.twig', [
            'users' => $results,
            'loggedIn'=>true,

        ]);
    }
    #[Route('/admin/{iduser}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user,sessionInterface $sessionInterface): Response
    {  if(!$this->hasPermissionRole($sessionInterface,"admin")){
        return $this->redirectToRoute('app_user_login');
    }
        return $this->render('user/show.html.twig', [
            'user' => $user,
            'loggedIn'=>true,

        ]);
    }

    #[Route('/admin/{iduser}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager,SessionInterface $sessionInterface): Response
    {
        if(!$this->hasPermissionRole($sessionInterface,"admin")){
            return $this->redirectToRoute('app_user_login');
        }
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'loggedIn'=>true,

        ]);
    }
  
    #[Route('/admin/{iduser}', name: 'app_user_delete', methods: ['POST'])]
        public function delete(Request $request, User $user, EntityManagerInterface $entityManager,SessionInterface $sessionInterface): Response
        {
            if(!$this->hasPermissionRole($sessionInterface,"admin")){
                return $this->redirectToRoute('app_user_login');
            }
            if ($this->isCsrfTokenValid('delete'.$user->getIduser(), $request->request->get('_token'))) {
                $entityManager->remove($user);
                $entityManager->flush();
            }
    
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }
    
        #[Route('/inscription', name: 'app_user_inscription', methods: ['GET', 'POST'])]
        public function inscription(Request $request, EntityManagerInterface $entityManager): Response
        {
            $user = new User();
            $form = $this->createForm(InscriptionType::class, $user);
            $form->handleRequest($request);
            $email = $user->getEmail();
            $error="";
            if ($form->isSubmitted() && $form->isValid()) {

           
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // Gérer les erreurs de validation de l'e-mail
                    // Par exemple, afficher un message d'erreur à l'utilisateur

                    $error='L\'adresse  n\'est pas valide.';

            } else {
                    // Si l'e-mail est valide, persister l'utilisateur
                $userExiste= $entityManager->getRepository(User::class)->findOneBy(["email"=>$email]);
                if($userExiste){
                $error='L\'adresse e-mail existe déja.';
 
                }else{
                    $user->setRole("membre");
                    $user->setMotdepasse(password_hash($user->getMotdepasse(), PASSWORD_BCRYPT, ["cost" => 12]));
                    $entityManager->persist($user);
                    $entityManager->flush();
                
                    return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
                    
                }
             }
            }
         
             return $this->renderForm('user/inscription.html.twig', [
                'user' => $user,
                'form' => $form,
                'error'=>$error
            ]);
        }
        #[Route('/login', name: 'app_user_login', methods: ['GET', 'POST'])]
        public function login(Request $request, EntityManagerInterface $entityManager,SessionInterface $sessionInterface): Response
        {
            
            if($this->isAuthenticated($sessionInterface)){
                if($this->hasPermissionRole($sessionInterface,"admin")){
                    return $this->redirectToRoute('app_user_index');
                }else{
                    return $this->redirectToRoute('app_user_profil');
 
                }
            }
            $userData = new User();
            $form = $this->createForm(LoginType::class, $userData);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
            $email = $userData->getEmail();
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $form->get('email')->addError(new FormError('L\'adresse e-mail n\'est pas valide.'));
            } else {
                $userFromDatabase= $entityManager->getRepository(User::class)->findOneBy(["email"=>$email]);
                if($userFromDatabase==null){
                    $error= "Cet utilisateur n'existe pas";
                    return $this->renderForm('user/Login.html.twig', [
                        'user' => $userData,
                        'form' => $form,
                        'error'=>$error
                    ]); 
                }else{
                    if(!password_verify($userData->getMotdepasse(),$userFromDatabase->getMotdepasse())){
                        $error= "Cet utilisateur n'existe pas";
                        return $this->renderForm('user/login.html.twig', [
                            'user' => $userData,
                            'form' => $form,
                            'error'=>$error
                        ]); 
                    }else{
                        $serializedUser = serialize($userFromDatabase);
                        $sessionInterface->set('user', $serializedUser);
                        if($this->hasPermissionRole($sessionInterface,"admin")){
                            return $this->redirectToRoute('app_user_index');
                        }else{
                            return $this->redirectToRoute('app_user_profil');
         
                        }
                    }
                }
           
                }
            }
         
             return $this->renderForm('user/login.html.twig', [
                'user' => $userData,
                'form' => $form,
            ]);
        }


        /*
        #[Route('/login', name: 'app_user_login', methods: ['GET', 'POST'])]
public function login(Request $request, EntityManagerInterface $entityManager, SessionInterface $sessionInterface): Response
{
    if ($this->isAuthenticated($sessionInterface)) {
        if ($this->hasPermissionRole($sessionInterface, "admin")) {
            return $this->redirectToRoute('app_user_index');
        } else {
            return $this->redirectToRoute('app_user_profil');
        }
    }

    $userData = new User();
    $loginForm = $this->createForm(LoginType::class, $userData);
    $registrationForm = $this->createForm(InscriptionType::class, $userData);

    $loginForm->handleRequest($request);
    $registrationForm->handleRequest($request);

    if ($loginForm->isSubmitted() && $loginForm->isValid()) {
        // Handle login form submission
        $email = $userData->getEmail();
        $userFromDatabase = $entityManager->getRepository(User::class)->findOneBy(["email" => $email]);

        if ($userFromDatabase == null || !password_verify($userData->getMotdepasse(), $userFromDatabase->getMotdepasse())) {
            $error = "Identifiants invalides";
            return $this->renderForm('Userfront/login.html.twig', [
                'user' => $userData,
                'login' => $loginForm,
                'registration' => $registrationForm,
                'error' => $error
            ]);
        }

        $serializedUser = serialize($userFromDatabase);
        $sessionInterface->set('user', $serializedUser);

        if ($this->hasPermissionRole($sessionInterface, "admin")) {
            return $this->redirectToRoute('app_user_index');
        } else {
            return $this->redirectToRoute('app_user_profil');
        }
    }

    if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {
        // Handle registration form submission
        $email = $userData->getEmail();
        $userExiste = $entityManager->getRepository(User::class)->findOneBy(["email" => $email]);

        if ($userExiste) {
            $registrationForm->get('email')->addError(new FormError('L\'adresse e-mail existe déjà.'));
        } else {
            $userData->setRole("membre");
            $userData->setMotdepasse(password_hash($userData->getMotdepasse(), PASSWORD_BCRYPT, ["cost" => 12]));
            $entityManager->persist($userData);
            $entityManager->flush();

            // Optionally, you can log in the user after registration
            $serializedUser = serialize($userData);
            $sessionInterface->set('user', $serializedUser);

            return $this->redirectToRoute('app_user_index');
        }
    }

    return $this->renderForm('Userfront/login.html.twig', [
        'user' => $userData,
        'login' => $loginForm,
        'registration' => $registrationForm,
    ]);
}*/

        #[Route('/profil', name: 'app_user_profil', methods: ['GET', 'POST'])]
        public function profil(SessionInterface $sessionInterface): Response
        {
            if(!$this->isAuthenticated($sessionInterface)){
                return $this->redirectToRoute('app_user_login') ;
            }
            $user=$this->getUserData($sessionInterface);
            return $this->renderForm('user/profil.html.twig', [
                'user' => $user,
                'loggedIn'=>true,

            ]);
        }
        #[Route('/profil/edit', name: 'app_user_profil_edit', methods: ['GET', 'POST'])]
        public function editProfil(SessionInterface $sessionInterface): Response
        {
            if(!$this->isAuthenticated($sessionInterface)){
                return $this->redirectToRoute('app_user_login') ;
            }
            $user=$this->getUserData($sessionInterface);
            return $this->renderForm('user/profil.html.twig', [
                'user' => $user,
            ]);
        }
        #[Route('/logout', name: 'app_user_logout', methods: ['GET', 'POST'])]
        public function logout(SessionInterface $sessionInterface): Response
        {
           
            $sessionInterface->set('user',null);
            return $this->redirectToRoute('app_user_login') ;

            
        }
    
}
