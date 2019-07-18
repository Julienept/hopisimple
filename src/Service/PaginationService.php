<?php

namespace App\Service;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\RequestStack;


class PaginationService {
    /**
     * @var string
     */
    private $entityClass;

    /**
     * @var integer
     */
    private $limit = 10;

    /**
     * @var integer
     */
    private $currentPage = 1;

    /**
     *
     * @var ObjectManager
     */
    private $manager;

    /**    
     * @var Twig\Environment
     */
    private $twig;

    /**     
     * @var string
     */
    private $route;

    /**     
     * @var string
     */
    private $templatePath;

    /**
     *
     * @param ObjectManager $manager
     * @param Environment $twig
     * @param RequestStack $request
     * @param string $templatePath
     */
    public function __construct(ObjectManager $manager, Environment $twig, RequestStack $request, string $templatePath) {

        $this->route        = $request->getCurrentRequest()->attributes->get('_route');        

        $this->manager      = $manager;
        $this->twig         = $twig;
        $this->templatePath = $templatePath;
    }

    /**
     * 
     * @return void
     */
    public function display() {
        $this->twig->display($this->templatePath, [
            'page' => $this->currentPage,
            'pages' => $this->getPages(),
            'route' => $this->route
        ]);
    }

    /**
     * @throws Exception 
     * 
     * @return int
     */
    public function getPages(): int {
        if(empty($this->entityClass)) {

            throw new \Exception("L'entité sur laquel paginer n'a pas été spécifiée. La méthode setEntityClass() de l'objet PaginationService doit être utilisée.");
        }
       
       
        $total = count($this->manager
                        ->getRepository($this->entityClass)
                        ->findAll());

        return ceil($total / $this->limit);
    }

    /**
     * 
     * @throws Exception 
     *
     * @return array
     */
    public function getData() {
        if(empty($this->entityClass)) {
            throw new \Exception("L'entité sur laquel paginer n'a pas été spécifiée. La méthode setEntityClass() de l'objet PaginationService doit être utilisée.");
        }

        $offset = $this->currentPage * $this->limit - $this->limit;
       
        return $this->manager
                        ->getRepository($this->entityClass)
                        ->findBy([], [], $this->limit, $offset);
    }
    
    /**
     *
     * @param int $page
     * @return self
     */
    public function setPage(int $page): self {
        $this->currentPage = $page;
        return $this;
    }

    /**
     *
     * @return int
     */
    public function getPage(): int {
        return $this->currentPage;
    }

    /**
     *
     * @param int $limit
     * @return self
     */
    public function setLimit(int $limit): self {
        $this->limit = $limit;
        return $this;
    }

    /**
     *
     * @return int
     */
    public function getLimit(): int {
        return $this->limit;
    }

    /**
     *
     * @param string $entityClass
     * @return self
     */
    public function setEntityClass(string $entityClass): self {
        $this->entityClass = $entityClass;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getEntityClass(): string {
        return $this->entityClass;
    }

    /**
     *
     * @param string $templatePath
     * @return self
     */
    public function setTemplatePath(string $templatePath): self {
        $this->templatePath = $templatePath;
        return $this;
    }

    /**
     *
     * @return string
     */ 
    public function getTemplatePath(): string {
        return $this->templatePath;
    }

    /**
     *
     * @param string $route 
     * @return self
     */
    public function setRoute(string $route): self {
        $this->route = $route;
        return $this;
    }
    
    /**
     *
     * @return string
     */
    public function getRoute(): string {
        return $route;
    }
}
