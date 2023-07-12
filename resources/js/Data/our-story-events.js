export const getOurStoryEvents = () => {
  const getBowieLevel = () => {
    const currentDate = new Date();
    const BowieBday = new Date(2020, 9, 22);
    const differenceInYears = Math.floor((currentDate - BowieBday) / (1000 * 60 * 60 * 24 * 365));

    return 4000 + differenceInYears * 1000;
  };

  const getCurrentlyMarried = () => {
    const currentDate = new Date().getTime();
    const weddingDate = new Date(2023, 8, 16, 14, 0, 0).getTime();

    return weddingDate <= currentDate;
  };

  return [
    {
      year: '2010',
      title: 'We First Met',
      description:
        'While Alex was "studying" at Siena College, Mike would come up to visit his best friend who was attending the same school. Mike and Alex would meet a few times and weren\'t more than acquaintances for many years.'
    },
    {
      year: '2016',
      title: 'We Meet Again',
      description:
        'After we both attended an engagement party for mutual friends from Siena, we would slowly start to see each other more often.'
    },
    {
      year: '2017',
      title: 'Billy Barnyard & The Bills',
      description:
        'So why do we call ourselves Bill, and what is the Billy Barnyard? Well, it\'s one of those "you had to be there" stories, but to put it short, Mike was giving Alex a ride upstate for a mutual friend\'s birthday. Passing a big red barn on the side of I-87, Alex pointed it out, and speaking with a hillbilly accent, she said "my cousin Billy lives there". We couldn\'t stop laughing about it. Ever since we\'ve referred to the barn as the Billy Barnyard and have called each other Bill.'
    },
    {
      year: '2017',
      title: 'Our First Date',
      description:
        "As we grew closer, Mike would eventually ask Alex out to dinner at Patricia's of Holmdel. We would revisit the restaurant each year on the same date."
    },
    {
      year: '2019',
      title: 'Our First Apartment',
      description:
        "After begging Mike to get move in together, we rented an apartment in Iselin, NJ and moved in. It was good middle ground between Mike's job in Somerville, NJ and Alex's job in Manhattan."
    },
    {
      year: '2020',
      title: 'Our First Pup',
      description: `Once we moved into the apartment, Alex had to find something else to beg Mike about, and of course, it was a puppy. After some resistance, Mike gave in. We brought home a Sheepadoodle and named him Bowie. However, he likes to be called Mansis, Stinky, and his official, certified title, Stinkman ${getBowieLevel()}, which he worked very hard for.`
    },
    {
      year: '2021',
      title: 'We Got Engaged',
      description:
        "On our way upstate to celebrate Alex's birthday, Mike pulled over on the side of I-87 in front of the Billy Barnyard. Alex thought something was wrong with the car, but Mike was there to ask her to be his wife. Through tears, she said yes."
    },
    {
      year: '2022',
      title: 'Our First Home',
      description:
        'Now that Mike was working from home permanently, we were able to move closer to the city and bought a wonderful condo in Hoboken, NJ. Even though Alex hates to admit it, she is officially a Jersey girl now (and secretly loves it)!'
    },
    {
      year: '2023',
      title: getCurrentlyMarried() ? 'We Got Married' : 'We Get Married!',
      description: getCurrentlyMarried()
        ? 'We are now married! We enjoyed celebrating our wedding day with you!'
        : 'We are so excited and cannot wait to celebrate our wedding day with you!'
    }
  ];
};
