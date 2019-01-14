CREATE DATABASE `aertrip`;
--
-- Table structure for table `aertrip_user_sessions`
--

CREATE TABLE `aertrip_user_sessions` (
  `session_id` varchar(32) NOT NULL,
  `data` text,
  `ip_address` varchar(16) NOT NULL,
  `user_agent` text NOT NULL,
  `active_status` tinyint(2) NOT NULL DEFAULT '1',
  `datetime` varchar(20) DEFAULT NULL,
  `inactive_datetime` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `password`) VALUES
(1, 'chikitsap', 'Chikitsa', 'Patel', 'b8e6429c72f97c9b7e0e1d1fb219b205');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aertrip_user_sessions`
--
ALTER TABLE `aertrip_user_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `session_id` (`session_id`) USING HASH,
  ADD KEY `session_id_idx` (`session_id`) USING HASH;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

