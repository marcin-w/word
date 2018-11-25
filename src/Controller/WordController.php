<?php

namespace App\Controller;

use App\Entity\UserHasWord;
use App\Entity\Word;
use App\Entity\WordData;
use App\Entity\WordTranslation;
use App\Form\WordType;
use App\Service\ApiClient;
use App\Service\Translator;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WordController extends AbstractController
{
    /**
     * @Route("/word", name="word")
     *
     * @param Request $request
     * @param ApiClient $apiClient
     * @param Translator $translator
     * @return Response
     * @throws Exception
     */
    public function index(Request $request, ApiClient $apiClient, Translator $translator): Response
    {
        $word = new Word();
        $form = $this->createForm(WordType::class, $word);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $wordRepository = $this->getDoctrine()->getRepository(Word::class);
            $wordName = $word->getName();
            $word = $wordRepository->findOneBy(['name' => $wordName]);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->getConnection()->beginTransaction();

            try {
                if (!$word) {
                    $word = new Word();
                    $word->setName($wordName);
                    $word->setItemStatus(1);
                    $word->setItemTimestamp(new \DateTime());

                    $entityManager->persist($word);
                    $entityManager->flush();
                }

//po co to zapytanie zawsze? jak nie ma $word to chyba wiadomo że tu też nie ma
                $userId = 1;
                $userHasWordRepository =  $this->getDoctrine()->getRepository(UserHasWord::class);
                $userHasWord = $userHasWordRepository->findBy(['word_id' => $word->getId(), 'user_id' => $userId]);
                if (!$userHasWord) {
                    $userHasWord = new UserHasWord();
                    $userHasWord->setWordId($word->getId());
                    $userHasWord->setUserId($userId);
                    $userHasWord->setItemStatus(1);
                    $userHasWord->setItemTimestamp(new \DateTime());

                    $entityManager->persist($userHasWord);
                    $entityManager->flush();
                }

//po co to zapytanie zawsze? jak nie ma $word to chyba wiadomo że tu też nie ma
                $wordTranslationRepository = $this->getDoctrine()->getRepository(WordTranslation::class);
                $wordTranslations = $wordTranslationRepository->findBy(['word_id' => $word->getId(), 'language_id' => 1]);

                $translations = [];
                foreach ($wordTranslations as $wordTranslation) {
                    $translations[] = $wordTranslation->getTranslation();
                }

                if (count($translations)) {
                    return $this->render('index.html.twig', ['form' => $form->createView(), 'translations' => $translations]);
                }

                $data = $apiClient->getResponse($word->getName(), 'en');

                $wordData = new WordData();
                $wordData->setWordId($word->getId());
                $wordData->setLanguageId(1);
                $wordData->setData($data);
                $wordData->setItemStatus(1);
                $wordData->setItemTimestamp(new \DateTime());
                $entityManager->persist($wordData);
                $entityManager->flush();

                //klasa może jutro
                $data = json_decode($data);

                $translations = $translator->retrieveTranslations($data);

                foreach ($translations as $translation) {
                    $wordTranslation = new WordTranslation();
                    $wordTranslation->setWordId($word->getId());
                    $wordTranslation->setLanguageId(1);
                    $wordTranslation->setTranslation($translation);
                    $wordTranslation->setItemStatus(1);
                    $wordTranslation->setItemTimestamp(new \DateTime());

                    $entityManager->persist($wordTranslation);
                    $entityManager->flush();
                }

                $entityManager->getConnection()->commit();
            } catch (Exception $e) {
                $entityManager->getConnection()->rollBack();
                throw $e;
            }

            return $this->render('index.html.twig', ['form' => $form->createView(), 'translations' => $translations]);
        }

        return $this->render('index.html.twig', ['form' => $form->createView()]);
    }
}
