<?php
// src/General/MoviedbBundle/DataFixtures/ORM/MovieFixtures.php

namespace General\MoviedbBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use General\MoviedbBundle\Entity\Movie;

class MovieFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $movie = new Movie();
        $movie->setReleased('1982');
        $movie->setTitle('Blade Runner');
        $movie->setGenre('Sci-fi');
        $movie->setSynopsis('In 2019, humans have genetically engineered Replicants, which are essentially humans who are designed for labor and entertainment purposes...');
        $em->persist($movie);

        $movie1 = new Movie();
        $movie1->setReleased('2001');
        $movie1->setTitle('Swordfish');
        $movie1->setGenre('Sci-fi');
        $movie1->setSynopsis('A secretive renegade counter-terrorist co-opts the world\'s greatest hacker (who is trying to stay clean) to steal billions in US Government dirty money.');
        $em->persist($movie1);

        $movie2 = new Movie();
        $movie2->setReleased('1980');
        $movie2->setTitle('Star Wars: Episode V - The Empire Strikes Back');
        $movie2->setGenre('Sci-Fi');
        $movie2->setSynopsis('After the rebels have been brutally overpowered by the Empire on their newly established base, Luke Skywalker takes advanced Jedi training with Master Yoda, while his friends are pursued by Darth Vader as part of his plan to capture Luke.');
        $em->persist($movie2);

        $movie3 = new Movie();
        $movie3->setReleased('1966');
        $movie3->setTitle('The Good, the Bad and the Ugly');
        $movie3->setGenre('Western');
        $movie3->setSynopsis('A bounty hunting scam joins two men in an uneasy alliance against a third in a race to find a fortune in gold buried in a remote cemetery.');
        $em->persist($movie3);

        $movie4 = new Movie();
        $movie4->setReleased('2011');
        $movie4->setTitle('The Intouchables');
        $movie4->setGenre('Comedy');
        $movie4->setSynopsis('After he becomes a quadriplegic from a paragliding accident, an aristocrat hires a young man from the projects to be his caretaker.');
        $em->persist($movie4);

        $movie5 = new Movie();
        $movie5->setReleased('1941');
        $movie5->setTitle('Citizen Kane');
        $movie5->setGenre('Drama');
        $movie5->setSynopsis('Following the death of a publishing tycoon, news reporters scramble to discover the meaning of his final utterance.');
        $em->persist($movie5);

        $movie6 = new Movie();
        $movie6->setReleased('1988');
        $movie6->setTitle('Die Hard');
        $movie6->setGenre('Action/Adventure');
        $movie6->setSynopsis('John McClane, officer of the NYPD, tries to save wife Holly Gennaro and several others, taken hostage by German terrorist Hans Gruber during a Christmas party at the Nakatomi Plaza in Los Angeles.');
        $em->persist($movie6);

        $movie7 = new Movie();
        $movie7->setReleased('1962');
        $movie7->setTitle('Lawrence of Arabia');
        $movie7->setGenre('Drama');
        $movie7->setSynopsis('A flamboyant and controversial British military figure and his conflicted loyalties during his World War I service in the Middle East.');
        $em->persist($movie7);

        $movie8 = new Movie();
        $movie8->setReleased('2006');
        $movie8->setTitle('Casino Royale');
        $movie8->setGenre('Action/Adventure');
        $movie8->setSynopsis('Armed with a license to kill, Secret Agent James Bond sets out on his first mission as 007 and must defeat a weapons dealer in a high stakes game of poker at Casino Royale, but things are not what they seem.');
        $em->persist($movie8);

        $movie9 = new Movie();
        $movie9->setReleased('1991');
        $movie9->setTitle('Terminator 2: Judgment Day');
        $movie9->setGenre('Sci-fi');
        $movie9->setSynopsis('A cyborg, identical to the one who failed to kill Sarah Connor, must now protect her teenage son, John, from a more advanced cyborg, made out of liquid metal.');
        $em->persist($movie9);

        $movie10 = new Movie();
        $movie10->setReleased('1999');
        $movie10->setTitle('The Matrix');
        $movie10->setGenre('Sci-fi');
        $movie10->setSynopsis('A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.');
        $em->persist($movie10);

        $movie11 = new Movie();
        $movie11->setReleased('1994');
        $movie11->setTitle('Forrest Gump');
        $movie11->setGenre('Drama');
        $movie11->setSynopsis('Forrest Gump, while not intelligent, has accidentally been present at many historic moments, but his true love, Jenny Curran, eludes him.');
        $em->persist($movie11);

        $movie12 = new Movie();
        $movie12->setReleased('2003');
        $movie12->setTitle('Lost in Translation');
        $movie12->setGenre('Drama');
        $movie12->setSynopsis('A faded movie star and a neglected young woman form an unlikely bond after crossing paths in Tokyo.');
        $em->persist($movie12);

        $movie13 = new Movie();
        $movie13->setReleased('1998');
        $movie13->setTitle('Saving Private Ryan');
        $movie13->setGenre('Action/Adventure');
        $movie13->setSynopsis('Following the Normandy Landings, a group of U.S. soldiers go behind enemy lines to retrieve a paratrooper whose brothers have been killed in action.');
        $em->persist($movie13);

        $movie14 = new Movie();
        $movie14->setReleased('1983');
        $movie14->setTitle('Trading Places');
        $movie14->setGenre('Comedy');
        $movie14->setSynopsis('A snobbish investor and a wily street con artist find their positions reversed as part of a bet by two callous ');
        $em->persist($movie14);

        $movie15 = new Movie();
        $movie15->setReleased('1984');
        $movie15->setTitle('Ghostbusters');
        $movie15->setGenre('Comedy');
        $movie15->setSynopsis('Three unemployed parapsychology professors set up shop as a unique ghost removal service.');
        $em->persist($movie15);

        $em->flush();

    }

    public function getOrder()
    {
        return 1; // The order in which the fixture will be loaded
    }
}